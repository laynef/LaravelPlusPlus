<?php

class DocumentationHelpCommand 
{

    private $ascii_art = "     _                               _             
    | |                             | |  _     _   
    | |     __ _ _ __ __ ___   _____| |_| |_ _| |_ 
    | |    / _` | '__/ _` \\ \\ / / _ \\ |_   _|_   _|
    | |___| (_| | | | (_| |\\ V /  __/ | |_|   |_|  
    \\_____/\\__,_|_|  \\__,_| \\_/ \\___|_|            
                                                  
    ";

    public function run($description, $version) {

echo "{$this->ascii_art}
Laravel Plus Plus Version: {$version}

Laravel Plus Plus: Command Line Interface to make your life easier.
=> The Laravel Plus Plus command is 'laravelpp'. To blast this project into the fifth dimension.
=> Use '--help' on any of the commands listed below for more details.

List of commands:
{$description}
";
    }
}
