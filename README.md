# Rogoss PHP-CLI

A small lib, to make building PHP based CLI-Tools easier.

# Usage

```php
<?php
    
    require_once __DIR__ . "./Cli.php";

    use \rogoss\Cli;

    function opt2Handler(Cli $cli) {

    }

    // Instantiate the CLI App
    Cli::init()

    // Leave a message for the user about what the App is currently doing
        ->headline("This is just a Demo App")    

    // Configure the available functions for the App
        ->addOption(
            "c",        // shortcut that the user can enter to choose the option
            "[c]lear",  // Label that is shown to the user
            fn(Cli $cli) => $cli->clear(), // Functiuon that is executed when 
                                           // The user chooses this option
        )

        ->addOption("o1", "option [1]", function(Cli $cli){
            // functions can be any kind of Closure
        })

        // you can also pass functions like this
        ->addOption("o2", "option [2]", "opt2Handler")

        // to quit the App, just call the `end()` method on the Cli-Class
        ->addOption("q", "[q]uit", fn(Cli $cli) => $cli->end())

    // Start the App
        ->run()
    ;
```

# 
