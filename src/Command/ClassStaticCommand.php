<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019-11-04
 * Time: 19:38.
 */
declare(strict_types=1);

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Command;

use Greeflas\StaticAnalyzer\Analyzer\ClassStaticAnalyzer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ClassStaticCommand extends Command
{
    /**
     * Define configuration for command.
     */
    protected function configure(): void
    {
        $this
            ->setName('stat:class-analyze')
            ->setDescription('Shows quantity of properties and methods with access identifiers in given class')
            ->addArgument(
                'class',
                InputArgument::REQUIRED,
                'Name of analyzed class'
            )
        ;
    }

    /**
     * @param OutputInterface $output
     *                                Handler for  stat:class-analyze command
     *
     * @throws \ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $className = $input->getArgument('class');

        try {
            if (\class_exists($className)) {
                $analyzer = new ClassStaticAnalyzer(new \ReflectionClass($className));
                $response = $analyzer->analyze();
            } else {
                throw new \Error('Class not found');
            }
        } catch (\Error $e) {
            $response = $e->getMessage();
        }
        $output->writeln($response);
    }
}
