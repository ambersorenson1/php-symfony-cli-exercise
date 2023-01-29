<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateTemplateCommand extends Command
{
protected function configure()
{
    $this
        ->setName('update-template')
        ->setDescription('Update a template from the JSON file')
        ->addArgument('id', InputArgument::REQUIRED, 'The id of the template you want to update')
        ->addArgument('message', InputArgument::REQUIRED, 'The new message of the template');
}
protected function execute(InputInterface $input, OutputInterface $output): int
{
    $id = $input->getArgument('id');
    $message = $input->getArgument('message');
    $templateJsonFile = 'src/data/templates.json';
    $templates = json_decode(file_get_contents($templateJsonFile), true);
    foreach ($templates as &$template) {
        if($template['id'] == $id){
            $template['message'] = $message;
            break;
        }

    }
    file_put_contents($templateJsonFile, json_encode($templates, JSON_PRETTY_PRINT));
    $output->writeln('Template updated successfully');
    return Command::SUCCESS;
}
}