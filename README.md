# Command Collection for Php command collection

free as in freedom free software collection of system commands

# Install

## By Hand

    mkdir -p vendor/net_bazzline/php_component_command_collection
    cd vendor/net_bazzline/php_component_command_collection
    git clone https://github.com/bazzline/php_component_command_collection .

## With [Packagist](https://packagist.org/packages/net_bazzline/php_component_command_collection)

    composer require net_bazzline/php_component_command_collection:dev-master

# History 

* upcomming
    @todo
        * [Filesystem/ListContent](https://github.com/bazzline/php_component_command/tree/master/example/Example/ls)
        * [Process/ListContent](https://github.com/bazzline/php_component_command/tree/master/example/Example/ps)
        * fixe issue that __invoke is not fitting to "Command::__invoke()"
* [0.0.9](https://github.com/bazzline/php_component_command_collection/tree/0.0.9) - released at 18.09.2015
    * all available commands are now extending from *AbstractCommand*
    * updated dependencies
* [0.0.8](https://github.com/bazzline/php_component_command_collection/tree/0.0.8) - released at 18.09.2015
    * added install howto to readme
    * updated dependencies
* [0.0.7](https://github.com/bazzline/php_component_command_collection/tree/0.0.7) - released at 16.09.2015
    * replaced behavior of "Curl::noSslSecurity" and added "Curl::noSslRevoke"
* [0.0.6](https://github.com/bazzline/php_component_command_collection/tree/0.0.6) - released at 14.09.2015
    * updated dependency
* [0.0.5](https://github.com/bazzline/php_component_command_collection/tree/0.0.5) - released at 12.09.2015
    * added [Http/Curl](https://github.com/bazzline/php_component_command_collection/blob/master/source/Net/Bazzline/Component/CommandCollection/Http/Curl.php)
* [0.0.4](https://github.com/bazzline/php_component_command_collection/tree/0.0.4) - released at 05.06.2015
    * replaced "/usr/bin/<command>" with "/usr/bin/env <command>" to extend compatibility with different platforms
* [0.0.3](https://github.com/bazzline/php_component_command_collection/tree/0.0.3) - released at 26.05.2015
    * fixed issue with git->create()
* [0.0.2](https://github.com/bazzline/php_component_command_collection/tree/0.0.2) - released at 26.05.2015
    * fixed namespace issue with git
* [0.0.1](https://github.com/bazzline/php_component_command_collection/tree/0.0.1) - released at 26.05.2015
    * initial release
