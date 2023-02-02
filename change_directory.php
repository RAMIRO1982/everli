<?php

class Path
{
    public $currentPath;

    function __construct(String $path)
    {
        $this->setCurrentPath($path);
    }

    function setCurrentPath(String $newPath)
    {
        $this->validatePath($newPath);
        $this->currentPath = $newPath;
    }

    function setCurrentDirectory(String $directory)
    {
        $currentPath = '';

        if($directory === '..')
        {
            $currentPathDirectories = explode('/', $this->currentPath);
            array_shift($currentPathDirectories);
            array_pop($currentPathDirectories);
            foreach($currentPathDirectories as $directory)
            {
                $currentPath .= '/'.$directory;
            }
        } else {
            $this->validateDirectory($directory);
            $currentPath = $this->currentPath. '/' . $directory;
        }

        $this->setCurrentPath($currentPath);
    }

    public function cd(String $command)
    {
        foreach(explode('/', $command) as $directory)
        {
            $this->setCurrentDirectory($directory);
        }
    }


    function validateRoot(String $path)
    {
        if(substr($path, 0, 1) !== '/')
        {
            die("Error: Root path must be '/'");
        }
    }

    function validatePath(String $path)
    {
        $this->validateRoot($path);

        $currentPathDirectories = explode('/', $path);
        array_shift($currentPathDirectories);

        foreach($currentPathDirectories as $directory)
        {
            $this->validateDirectory($directory);
        }
    }

    function validateDirectory(String $directory)
    {
        if(!preg_match("/^[a-zA-Z]+$/", $directory))
        {
            die("Error: Directory names must consist only of English alphabet letters (A-Z and a-z)");
        }
    }

}

$path = new Path('/a/b/c/d');
$path->cd('../x');
echo $path->currentPath;
