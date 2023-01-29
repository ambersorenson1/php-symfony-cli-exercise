<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteTemplateCommand extends Command
{
 protected function configure()
 {
     $this
         ->setName('delete-template')
         ->setDescription('Delete a template from the JSON file')
         ->addArgument('id', InputArgument::REQUIRED, 'The id of the template you want to delete');

 }
 protected function execute(InputInterface $input, OutputInterface $output): int
 {
    $id = $input->getArgument('id');
    $templatesJsonFile = 'src/data/templates.json';
    $templates = json_decode(file_get_contents($templatesJsonFile), true);
//  This is removing all elements from the array $templates which have an 'id' key with a value equal to variable $id and store it in $newTemplates variable
    $newTemplates = array_filter($templates, function ($template) use ($id){
        return $template['id'] !=$id;
    });
    file_put_contents($templatesJsonFile, json_encode($newTemplates, JSON_PRETTY_PRINT));
    $output->writeln('Template was deleted successfully');
     return Command::SUCCESS;
 }
}