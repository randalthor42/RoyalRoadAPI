# Fiction API

Welcome to the Fiction API, a RESTful API designed to interact with fiction stories from RoyalRoad.

## Endpoints

- `GET /api/{website}/fiction/{id}`: Retrieve details of a specific fiction story.
- `GET /api/{website}/fiction/{id}/?include=chapters`: Retrieve fiction info with a list of all its related chapters.
- `GET /api/{website}/fiction/{id}/?include=chapters:chapterIndex`: Retrieve fiction info with the content of a specific chapter.
- `GET /api/{website}/fiction/{id}/chapters`: Retrieve a chapter list only of a specific fiction.
- `GET /api/{website}/fiction/{id}/chapters/{chapterIndex}`: Retrieve a specific chapter with the content.

## Installation

1. Clone this repository.

```bash
git clone https://github.com/randalthor42/RoyalRoadAPI.git
```

2. Navigate to the project directory.

```bash
cd RoyalRoadAPI
```

3. Install the required dependencies.

```bash
npm install
composer update
```

4. Create a copy of the `.env.example` file and rename it to `.env`.

```bash
cp .env.example .env
```

5. Update the `.env` file with your database configuration details.

6. Run the database migrations.
```bash
php artisan migrate
```

7. Generate an API key for your application using the custom Artisan command.
```bash
php artisan api:generate-key [USER_ID] [RATE_LIMIT]
```

8. Start the server.
```bash
php artisan serve
```

## Usage with Postman

To test the API using Postman:

1. Open Postman.
2. Set the request type to GET
3. Input the desired endpoint URL.
4. Include the generated API key in the headers as x-api-key
5. Send the request and observe the returned data.

## Contributing

Contributions are welcome! If you have any ideas, suggestions, or bug reports, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).
