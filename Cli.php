<?php

namespace rogoss\Cli;

class Cli
{

    /** @var array - array[
     * `shortcut` => [
     *      "label" => `displayed text to user`,
     *      "handler" => `closure(Cli $oCLI)`
     *  ]
     */
    protected $aOpts = [];

    protected $sHeadline = "";

    protected $bRunning = false;

    public static function Init()
    {
        return new static();
    }

    public function clear(): static
    {
        echo "\ec"; // Ansii => clear console
        return $this;
    }

    public function headline(string $sHeadline): static {
        $this->sHeadline = $sHeadline;
        return $this; 
    }

    public function addOption(string $sShortcut, string $sLabel, \Closure $hHandler): static
    {
        if ($sShortcut == "?")
            throw new \Exception("can't assign '?' shortcut");

        $this->aOpts[$sShortcut] = ['label' => $sLabel, 'handler' => $hHandler];
        return $this;
    }

    public function end(): static
    {
        $this->bRunning = false;
        return $this;
    }

    public function run()
    {
        $this->bRunning = true;
        while ($this->bRunning) {
            echo $this->sHeadline;
            $line = trim(readline("What to do? [? for help]: "));
            if (empty($line) or $line == "?") {
                $this->showOpts();
            } else if (!isset($this->aOpts[$line])) {
                echo "I Could not understand you !\n";
            } else {
                $fnc = $this->aOpts[$line]['handler'];
                $fnc($this);
            }
        }
    }

    protected function showOpts()
    {
        echo "\nyour options: \n",
        "-------------";

        foreach ($this->aOpts as $i => $aOpt)
            echo "\n", $i, ": ", $aOpt['label'];

        echo "\n\n";
    }



    protected function __construct() {}
}
