<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowSentMessagesCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('show-messages')
            ->setDescription('Show the messages stored in the messages.json file');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonMessageFile = 'src/data/messages.json';
        $messages = json_decode(file_get_contents($jsonMessageFile), true);


        foreach ($messages as $message) {
            if (array_key_exists('timestamp', $message)) {
                $output->writeln(sprintf(
                    '[%s] %s',
                    $message['timestamp'],
                    json_encode($message['content'])
                ));
            }
        }
        return Command::SUCCESS;
    }
}