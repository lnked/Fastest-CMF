<?php
/*
|--------------------------------------------------------------------------
| CELEBRO.CMS (http://cms.celebro.ru)
|
| @copyright Copyright (c) CELEBRO lab. (http://celebro.ru)
|
| @license http://cms.celebro.ru/license.txt
|--------------------------------------------------------------------------
*/
require __DIR__."/../apps/bootstrap/app.php";

// ng serve --host 0.0.0.0 --port 4201 --live-reload-port 49153


// .
// ├── bin                      # Build/Start scripts
// ├── config                   # Project and build configurations
// ├── public                   # Static public assets (not imported anywhere in source code)
// ├── server                   # Express application that provides webpack middleware
// │   └── main.js              # Server application entry point
// ├── src                      # Application source code
// │   ├── index.html           # Main HTML page container for app
// │   ├── main.js              # Application bootstrap and rendering
// │   ├── components           # Global Reusable Presentational Components
// │   ├── containers           # Global Reusable Container Components
// │   ├── layouts              # Components that dictate major page structure
// │   │   └── CoreLayout.js    # CoreLayout which receives children for each route
// │   │   └── CoreLayout.scss  # Styles related to the CoreLayout
// │   │   └── index.js         # Main file for layout
// │   ├── routes               # Main route definitions and async split points
// │   │   ├── index.js         # Bootstrap main application routes with store
// │   │   ├── Home             # Fractal route
// │   │   │   ├── index.js     # Route definitions and async split points
// │   │   │   ├── assets       # Assets required to render components
// │   │   │   ├── components   # Presentational React Components
// │   │   │   └── routes **    # Fractal sub-routes (** optional)
// │   │   └── Counter          # Fractal route
// │   │       ├── index.js     # Counter route definition
// │   │       ├── container    # Connect components to actions and store
// │   │       ├── modules      # Collections of reducers/constants/actions
// │   │       └── routes **    # Fractal sub-routes (** optional)
// │   ├── store                # Redux-specific pieces
// │   │   ├── createStore.js   # Create and instrument redux store
// │   │   └── reducers.js      # Reducer registry and injection
// │   └── styles               # Application-wide styles (generally settings)
// └── tests                    # Unit tests
