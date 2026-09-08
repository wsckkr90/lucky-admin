# SEO Manager performance fix

The SEO Manager now loads only lightweight website fields for the website selector and loads the full SEO page payload only for the selected website. Missing default public pages are repaired only for the selected site instead of checking every page for every site on every request.

This keeps the multi-site and public-page selection behavior unchanged while reducing database work and avoiding unnecessary loading of large `schema_json` and `extra_head` fields from unrelated sites.
