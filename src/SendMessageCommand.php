<?php

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

//class SendMessageCommand extends Command
//{
//    protected static $defaultName = 'slack:send-message';
//
//    protected function configure(): void
//    {
//        $this
//            ->setDescription('Prompts a user to select an option and sends a message.');
//    }
//
//    protected function execute(InputInterface $input, OutputInterface $output): int
//    {
//        // ... other code here ...
//
//        switch ($answer) {
//            case "0":
//                $output->writeln('Send a message');
//                $this->SendMessageCommand($input, $output);
//                break;
//            // ... other cases here ...
//        }
//
//        // ... other code here ...
//        return Command::SUCCESS;
//    }
//
//    private function SendMessageCommand(InputInterface $input, OutputInterface $output): int
//    {
//        $helper = $this->getHelper('question');
//        $question = new ChoiceQuestion('Please select a template to send', 'None');
//
//        // Read the templates from templates.json
//        $jsonTemplate = file_get_contents('src/data/templates.json');
//        $templates = json_decode($jsonTemplate, true);
//        $templateChoices = [];
//
//        // Add the templates to the list of choices
//        foreach ($templates as $template) {
//            $templateChoices[] = $template['message'];
//        }
//
//        $question->setChoices($templateChoices);
//
//        $selectedTemplate = $helper->ask($input, $output, $question);
//
//        // Get the selected message
//        foreach ($templates as $template) {
//            if ($template['message'] === $selectedTemplate) {
//                $selectedMessage = $template['message'];
//                break;
//            }
//        }
//
//        // Get the current date and time
//        $date = date('Y-m-d H:i:s');
//
//        // Store the message in messages.json
//        $jsonMessage = file_get_contents('src/data/messages.json');
//        $messages = json_decode($jsonMessage, true);
//        $messages[] = [
//            'date' => $date,
//            'message' => $selectedMessage,
//        ];
//        file_put_contents('src/data/messages.json', json_encode($messages, JSON_PRETTY_PRINT));
//
//        $output->writeln('Message sent successfully: ' . $selectedMessage);
//
//        return Command::SUCCESS;
//    }
//}



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
