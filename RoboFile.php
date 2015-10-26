<?php


require_once 'vendor/autoload.php';


use Symfony\Component\Yaml\Parser;

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{

    public function read()
    {

        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents('eblast-defs/eblast2.def'));

        $this->say($value['headline']);
        var_dump($value);
        // $file_handle = fopen("eblast-defs/eblast2.def", "r");
        // while (!feof($file_handle)) {
        //    $line = fgets($file_handle);
        //    echo $line;
        // }
        // fclose($file_handle);
    }

    // Define public methods as commands.
    public function generate($action = 'status')
    {
        $loader = new Twig_Loader_Filesystem('templates');
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate('master.twig');

        $yaml = new Parser();
        $def = 'eblast-defs/eblast1.yml';
        $contents = $yaml->parse(file_get_contents($def));

        $action = $template->render($contents);

        file_put_contents("output/development.html", $action);


        // $loader = new Twig_Loader_Array(array(
        //   'index' => 'Hello {{ name }}!',
        // ));

        // $twig = new Twig_Environment($loader);

        // $action = $twig->render('index', array('name' => 'Fabien'));

        //$this->say($action);
        //$this->taskExec("dir")->run();
    }
}