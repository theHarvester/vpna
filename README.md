## VPNA

### Adding a config

Revision is required.

Config is not yet defined clearly, it will accept anything.

```
POST box/{box id}

{
    "revision":"1234",
    "config": {  }
}
```

### Retreiving a config

```
GET box/{box id}
```

### Retreiving a config with a revision number

```
GET box/{box id}/revision/{revision id}

Response - 404 - The whole config could not be found
Response - 200 - The config was out of date and a current version is returned
Response - 204 - You are on the current revision and there's nothing to be done
```