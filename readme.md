# Sky Bet Tech Test

### Prerequisites

The following instructions assume phpunit is install globally.
For instructions on running phpUnit [Go Here](https://github.com/sebastianbergmann/phpunit)

php5.6

### To run tests:

```$ phpunit --verbose```

from root directory.

### To run app:

```$ php -S localhost:8080```

from `/public` directory. 

### In your browser:

Navigate to `localhost:8080`

#### Notes:

The Frontend Javascript App is provided compiled for ease of use.

If for any reason the app needs to be rebuilt:

(assuming NPM is installed globally)

Install webpack globally

```$ npm install webpack -g```

Install dependencies

```$ npm install```

Rebuild App

```$ webpack --watch```