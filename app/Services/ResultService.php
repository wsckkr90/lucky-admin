<?php

namespace App\Services;

use App\Models\GameResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use App\Models\ActivityLog;

class ResultService
{

    /**
     * Create a new game result.
     */
    public function create(array $data): GameResult
    {
        return DB::transaction(function () use ($data) {

            $existing = GameResult::query()
                ->where('game_id', $data['game_id'])
                ->whereDate('result_date', $data['result_date'])
                ->first();

            if ($existing) {
                throw new RuntimeException(
                    'A result already exists for this game and date.'
                );
            }
          $data = $this->validateResultData($data);
            $result = GameResult::create([
                'game_id' => $data['game_id'],
                'result_date' => $data['result_date'],

                'open_panna' =>
                    $data['open_panna'] ?? null,

                'jodi' =>
                    $data['jodi'] ?? null,

                'close_panna' =>
                    $data['close_panna'] ?? null,

                'result' =>
                    $data['result'] ?? null,

                'source' =>
                    $data['source'] ?? 'manual',

                'status' =>
                    $data['status'] ?? 'published',

                'created_by' =>
                    $data['created_by'] ?? Auth::id(),

                'updated_by' =>
                    $data['updated_by'] ?? Auth::id(),
            ]);

            $this->log(
                action: 'created',
                result: $result,
                oldValues: null,
                newValues: $result->toArray()
            );

            return $result;
        });
    }

    /**
     * Create or update today's result.
     */
    public function upsertToday(
        int $gameId,
        array $data
    ): GameResult {
        return $this->upsert(
            $gameId,
            today()->toDateString(),
            $data
        );
    }

    /**
     * Create or update a result for a specific game/date.
     */
    public function upsert(
        int $gameId,
        string $date,
        array $data
    ): GameResult {
        return DB::transaction(function () use (
            $gameId,
            $date,
            $data
        ) {
            $data = $this->validateResultData($data);
            $result = GameResult::query()
                ->where('game_id', $gameId)
                ->whereDate('result_date', $date)
                ->first();

            if (!$result) {
                return $this->create([
                    'game_id' => $gameId,
                    'result_date' => $date,

                    'open_panna' =>
                        $data['open_panna'] ?? null,

                    'jodi' =>
                        $data['jodi'] ?? null,

                    'close_panna' =>
                        $data['close_panna'] ?? null,

                    'result' =>
                        $data['result'] ?? null,

                    'source' =>
                        $data['source'] ?? 'manual',

                    'status' =>
                        $data['status'] ?? 'published',

                    'created_by' =>
                        $data['created_by'] ?? Auth::id(),

                    'updated_by' =>
                        $data['updated_by'] ?? Auth::id(),
                ]);
            }

            $oldValues = $result->toArray();

            $result->update([
                'open_panna' =>
                    array_key_exists(
                        'open_panna',
                        $data
                    )
                        ? $data['open_panna']
                        : $result->open_panna,

                'jodi' =>
                    array_key_exists(
                        'jodi',
                        $data
                    )
                        ? $data['jodi']
                        : $result->jodi,

                'close_panna' =>
                    array_key_exists(
                        'close_panna',
                        $data
                    )
                        ? $data['close_panna']
                        : $result->close_panna,

                'result' =>
                    array_key_exists(
                        'result',
                        $data
                    )
                        ? $data['result']
                        : $result->result,

                'source' =>
                    $data['source']
                    ?? $result->source,

                'status' =>
                    $data['status']
                    ?? $result->status,

                'updated_by' =>
                    $data['updated_by']
                    ?? Auth::id(),
            ]);

            $this->log(
                action: 'updated',
                result: $result->fresh(),
                oldValues: $oldValues,
                newValues: $result->fresh()->toArray()
            );

            return $result->fresh();
        });
    }

    /**
     * Update an existing result.
     */
    public function update(
        GameResult $result,
        array $data
    ): GameResult {
        return DB::transaction(function () use (
            $result,
            $data
        ) {
            $oldValues = $result->toArray();

            $result->update([
                'game_id' =>
                    $data['game_id']
                    ?? $result->game_id,

                'result_date' =>
                    $data['result_date']
                    ?? $result->result_date,

                'open_panna' =>
                    $data['open_panna']
                    ?? $result->open_panna,

                'jodi' =>
                    $data['jodi']
                    ?? $result->jodi,

                'close_panna' =>
                    $data['close_panna']
                    ?? $result->close_panna,

                'result' =>
                    $data['result']
                    ?? $result->result,

                'source' =>
                    $data['source']
                    ?? $result->source,

                'status' =>
                    $data['status']
                    ?? $result->status,

                'updated_by' =>
                    $data['updated_by']
                    ?? Auth::id(),
            ]);

            $fresh = $result->fresh();

            $this->log(
                action: 'updated',
                result: $fresh,
                oldValues: $oldValues,
                newValues: $fresh->toArray()
            );

            return $fresh;
        });
    }

    /**
     * Delete a result.
     */
    public function delete(GameResult $result): void
    {
        DB::transaction(function () use ($result) {

            $oldValues = $result->toArray();

            $this->log(
                action: 'deleted',
                result: $result,
                oldValues: $oldValues,
                newValues: null
            );

            $result->delete();
        });
    }

    /**
     * Activity logging.
     */
   protected function log(
    string $action,
    GameResult $result,
    ?array $oldValues,
    ?array $newValues
): void {
    ActivityLog::create([
        'user_id' =>
            Auth::id(),

        'action' =>
            'result.' . $action,

        'module' =>
            'results',

        'record_type' =>
            GameResult::class,

        'record_id' =>
            $result->id,

        'old_values' =>
            $oldValues,

        'new_values' =>
            $newValues,

        'ip_address' =>
            request()->ip(),

        'user_agent' =>
            request()->userAgent(),
    ]);

}

public function validateResultData(
    array $data
): array {
    $data['open_panna'] =
        $this->normalizeResultValue(
            $data['open_panna'] ?? null
        );

    $data['jodi'] =
        $this->normalizeResultValue(
            $data['jodi'] ?? null
        );

    $data['close_panna'] =
        $this->normalizeResultValue(
            $data['close_panna'] ?? null
        );

    $data['result'] =
        $this->normalizeResultValue(
            $data['result'] ?? null
        );

    return $data;
}

protected function normalizeResultValue(
    mixed $value
): ?string {
    if ($value === null) {
        return null;
    }

    $value = trim(
        (string) $value
    );

    if (
        $value === '' ||
        $value === '--' ||
        $value === '---' ||
        $value === '**' ||
        $value === '***'
    ) {
        return null;
    }

    return $value;
}
}
