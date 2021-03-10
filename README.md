# install

sample project to reproduce the issue [852](https://github.com/sebastianbergmann/php-code-coverage/issues/852)

clone the repository

install the dependencies with composer

generate the coverage report with :
```
XDEBUG_MODE=coverage ./vendor/bin/behat --config behat.yml
```

the result is the following one, where I would expect a 100% coverage

![result.png](result.png)
