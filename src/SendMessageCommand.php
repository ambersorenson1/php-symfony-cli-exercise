<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class SendMessageCommand extends Command
{
    protected static $defaultName = 'send-message';

    protected function configure()
    {
        $this
            ->setDescription('Sends a message from templates.json to messages.json with date and time')
            ->addArgument('message_id', InputArgument::REQUIRED, 'The ID of the message to send')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $messageId = $input->getArgument('message_id');

        // Load the templates.json file
        $templates = json_decode(file_get_contents('src/data/templates.json'), true);
        $message = [
            'content' => $templates[$messageId],
            'timestamp' => (new \DateTime())->format('D M d Y H:i:s T'),
        ];

        // Append the message to messages.json
        $messages = json_decode(file_get_contents('src/data/messages.json'), true);
        $messages[] = $message;
        file_put_contents('src/data/messages.json', json_encode($messages, JSON_PRETTY_PRINT));

        $output->writeln(sprintf('<info>Message with ID "%s" sent at %s</info>', $messageId, $message['timestamp']));
        return Command::SUCCESS;
    }
}
