<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListTemplatesCommand extends Command
{
 protected function configure(): void
 {
     $this->setName('list-templates')
         ->setDescription('Lists the templates from a JSON file.');
 }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonTemplate = file_get_contents('src/data/templates.json');
        $templates = json_decode($jsonTemplate, true);
            foreach ($templates as $template) {
                $output->writeln($template['message']);
            }

        return Command::SUCCESS;
    }
}

