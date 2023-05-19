# Fiction API

Welcome to the Fiction API, a RESTful API designed to interact with fiction stories from RoyalRoad.

## Endpoints

- `GET /api/fiction/{id}`: Retrieve details of a specific fiction story.
- `GET /api/fiction/{id}/?include=chapters`: Retrieve fiction info with a list of all its related chapters.
- `GET /api/fiction/{id}/?include=chapters:chapterIndex`: Retrieve fiction info with the content of a specific chapter.
- `GET /api/fiction/{id}/chapters`: Retrieve a chapter list only of a specific fiction.
- `GET /api/fiction/{id}/chapters/{chapterIndex}`: Retrieve a specific chapter with the content.

## Installation

1. Clone this repository.

```bash
git clone https://github.com/randalthor42/RoyalRoadAPI.git
```
2. Install the required dependencies.

```bash
npm install
composer update
```

3. Start the server.

```bash
php artisan serve
```



## Contributing

Contributions are welcome! If you have any ideas, suggestions, or bug reports, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).