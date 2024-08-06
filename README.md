# fileShareApi Documentation

## Endpoints

| Method   | URL                                      | Description                              |
| -------- | ---------------------------------------- | ---------------------------------------- |
| `GET`    | `/api/files`                             | Retrieve all files.                      |
| `GET`    | `/api/files/{file}`                      | Retrieve data for desired file.          |
| `POST`   | `/api/files`                             | Save new file.                           |

## Payloads

`POST` | `/api/files`

| Query key  | Type     | Description                              | Extra comments                           |
| ---------- | -------- | ---------------------------------------- | ---------------------------------------- |
| `name`     | `String` | Name of file                             | Required                                 |
| `photo`    | `File`   | File content                             | Required                                 |
| `title`    | `String` | Title of the file                        | Required                                 |
| `description` | `String`   | Description of the file             | Required                                 |

## HTTP Response Status Codes

| Code  | Title                     | Description                              |
| ----- | ------------------------- | ---------------------------------------- |
| `200` | `OK`                      | Request successfully processed           |
| `201` | `Created`                 | Record has been added to the database    |
| `401` | `Unauthenticated`         | Token is not correct                     |
| `404` | `Not found`               | Record does not exist                    |
| `405` | `Method not allowed`      | Request to wrong endpoint                |
| `422` | `Unprocessable content`   | Request is missing specified parameters  |
| `429` | `Too many requests`   | Maximum number of requests in given time frame is reached  |

## Request limits

`GET` Requests are limited to 10 per minute.
`POST` Requests are limited to 5 per minute.

For more details check in the `Errors` section.

## Errors

When errors occur the consumer will get a JSON payload verifying that an error occurred together with a reason for why the error occurred.

### If token is not set when sending request:

![Token is not set.](public/readme_images/unauthenticated_err.png)

```
{
    "message": "Unauthenticated."
}
```

### Missing required parameter in request

![Missing required parameter in request.](public/readme_images/unsuccessful_post.png)

```
{
    "message": "The title field is required.",
    "errors": {
        "title": [
            "The title field is required."
        ]
    }
}
```

### Uploading file that is not image

![File can only be image.](public/readme_images/file_mime_error.png)

```
{
    "message": "File MIME type must be image.",
    "errors": {
        "photo": [
            "File MIME type must be image."
        ]
    }
}
```

### Uploading image that is too big

![File is too big.](public/readme_images/file_size_error.png)

```
{
    "message": "Image size must be less than 1 MB.",
    "errors": {
        "photo": [
            "Image size must be less than 1 MB."
        ]
    }
}
```

### Too many GET/POST requests 

![Too many GET requests.](public/readme_images/get_request_limit.png)

```
{
    "error": "Number of GET requests per minute is limited to 10."
}
```

![Too many POST requests.](public/readme_images/post_request_limit.png)

```
{
    "error": "Number of POST requests per minute is limited to 5."
}
```

## Examples of successful requests

### Successful post request

![Successful post request.](public/readme_images/successful_post.png)

```
{
    "data": {
        "id": 4,
        "name": "from api 4",
        "file_type": {
            "dirname": "/home/web/demoproject/storage/app/public/files",
            "basename": "2b55e15e-13dc-4aaf-ab9d-00ad358a9422.jpg",
            "extension": "jpg",
            "filename": "2b55e15e-13dc-4aaf-ab9d-00ad358a9422"
        },
        "file_size": 64558,
        "path": "files/2b55e15e-13dc-4aaf-ab9d-00ad358a9422.jpg"
    }
}
```

### Collection of items

![Successful collection request.](public/readme_images/successful_collection.png)

```
{
    "data": [
        {
            "id": 1,
            "name": "from api 1",
            "file_type": {
                "dirname": "/home/web/demoproject/storage/app/public/files",
                "basename": "92ec8788-4206-486d-99e9-ced50f55fe69.jpg",
                "extension": "jpg",
                "filename": "92ec8788-4206-486d-99e9-ced50f55fe69"
            },
            "file_size": 64558,
            "path": "files/92ec8788-4206-486d-99e9-ced50f55fe69.jpg"
        },
        {
            "id": 2,
            "name": "from api 2",
            "file_type": {
                "dirname": "/home/web/demoproject/storage/app/public/files",
                "basename": "ad9782cb-f4af-45d1-af42-5d976aa0f894.jpg",
                "extension": "jpg",
                "filename": "ad9782cb-f4af-45d1-af42-5d976aa0f894"
            },
            "file_size": 64558,
            "path": "files/ad9782cb-f4af-45d1-af42-5d976aa0f894.jpg"
        },
        {
            "id": 3,
            "name": "from api 3",
            "file_type": {
                "dirname": "/home/web/demoproject/storage/app/public/files",
                "basename": "f0815ee0-0bae-47e4-8119-7cd5af49bae2.jpg",
                "extension": "jpg",
                "filename": "f0815ee0-0bae-47e4-8119-7cd5af49bae2"
            },
            "file_size": 64558,
            "path": "files/f0815ee0-0bae-47e4-8119-7cd5af49bae2.jpg"
        }
    ]
}
```

### Item

![Successful item request.](public/readme_images/successful_item.png)

```
{
    "data": {
        "id": 1,
        "name": "from api 1",
        "file_type": {
            "dirname": "/home/web/demoproject/storage/app/public/files",
            "basename": "92ec8788-4206-486d-99e9-ced50f55fe69.jpg",
            "extension": "jpg",
            "filename": "92ec8788-4206-486d-99e9-ced50f55fe69"
        },
        "file_size": 64558,
        "path": "files/92ec8788-4206-486d-99e9-ced50f55fe69.jpg"
    }
}
```