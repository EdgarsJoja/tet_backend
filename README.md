About app
---

This is BE app, that provides API for euro currency exchange rates.

API endpoints
---

- `api/v1/currency/list` - provides paginated list of available currencies.
Pass "page" param, to specify which page of results to retrieve. 
Example: `api/v1/currency/list?page=3`.

- `api/v1/currency/{id}` - provides detailed results of a specific currency
with all saved past exchange rates.
Example: `api/v1/currency/3`.

Information updates
---

#### Cron
Task to get latest RSS feed and update DB has been scheduled to run every 5 minutes.

#### Console command
It is also possible to manually trigger RSS feed download and DB update by running
`php artisan tet:rss:load` command.
