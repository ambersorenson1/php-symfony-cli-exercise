<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Process\Process;


class SlackCommand extends Command
{
    protected static $defaultName = 'slack';

    protected function configure(): void
    {

        $this
            ->setDescription('Prompts a user to select an option.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $continue = true;
        while ($continue) {
            $helper = $this->getHelper('question');
            $question = new ChoiceQuestion('What would you like to do? Please select a number 0-8', ['0. Send a message', '1. List templates', '2. Add a template', '3. Update a template', '4. Delete a template',
                '5. List users', '6. Add a user', '7. Show sent messages', '8. Exit']);
            $answer = $helper->ask($input, $output, $question);
            switch ($answer) {
                case "0":
                    $output->writeln('Send a message');
                    $this->SendMessageCommand($input, $output);
                    break;
                case "1":
                    $output->writeln('List templates');
                    $this->ListTemplatesCommand($input, $output);
                    break;
            }

        }
        return Command::SUCCESS;
    }
}