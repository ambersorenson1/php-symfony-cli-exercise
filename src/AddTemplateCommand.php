<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddTemplateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('add-template')
            ->setDescription('Add a template to the JSON file')
            ->addArgument('message', InputArgument::REQUIRED, 'The message the new template');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $message = $input->getArgument('message');
        $templatesJsonFile = 'src/data/templates.json';
        $templates = json_decode(file_get_contents($templatesJsonFile), true);
        $highestId = 0;
        foreach ($templates as $template) {
            if ($template['id'] > $highestId) {
                $highestId = $template['id'];
            }
        }
        $newId = $highestId + 1;
        $newTemplate = [
            'id' => $newId,
            'message' => $message
        ];
        $templates[] = $newTemplate;
        file_put_contents($templatesJsonFile, json_encode($templates, JSON_PRETTY_PRINT));
        $output->writeln('Template was added successfully with id:' . $newId);
        return Command::SUCCESS;
    }
}