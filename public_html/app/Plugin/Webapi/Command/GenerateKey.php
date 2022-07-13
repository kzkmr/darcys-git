<?php


namespace Plugin\Webapi\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Eccube\Common\EccubeConfig;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class GenerateKey
 * @package Plugin\Webapi\Command
 * @author Tyler Nguyen <tylermagento@gmail.com>
 * @created : 13/03/2022
 */
class GenerateKey extends Command {
    protected static $defaultName = 'eccube:webapi:key:generate';

    private $filesystem;

    private $ecConfig;

    private $privateKey;

    private $publicKey;

    private $passphrase;


    public function __construct(Filesystem $filesystem, EccubeConfig $ecConfig)
    {
        $this->filesystem = $filesystem;
        $this->ecConfig = $ecConfig;
        parent::__construct();
    }
    protected function configure()
    {
        $this->privateKey = $this->ecConfig->get('jwt_key_private');
        $this->publicKey = $this->ecConfig->get('jwt_key_public');
        $this->passphrase = $this->ecConfig->get('jwt_key_passphrase');

        $this->setDescription('Generate public/private keys for use in your application.');
        $this->addOption('skip-if-exists', null, InputOption::VALUE_NONE, 'Do not update key files if they already exist.');
        $this->addOption('overwrite', null, InputOption::VALUE_NONE, 'Overwrite key files if they already exist.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $alreadyExists = $this->filesystem->exists($this->privateKey) || $this->filesystem->exists($this->publicKey);
        [$secretKey, $publicKey] = $this->generateKeyPair($this->passphrase);
        if ($alreadyExists) {
            try {
                $this->handleExistingKeys($input);
            } catch (\RuntimeException $e) {
                if (0 === $e->getCode()) {
                    $io->comment($e->getMessage());

                    return 0;
                }

                $io->error($e->getMessage());

                return 1;
            }
            if (!$io->confirm('You are about to replace your existing keys. Are you sure you wish to continue?')) {
                $io->comment('Your action was canceled.');
                return 0;
            }
        }
        $io->writeln($secretKey);
        $io->newLine();
        $io->writeln($publicKey);

        $this->filesystem->dumpFile($this->privateKey, $secretKey);
        $this->filesystem->dumpFile($this->publicKey, $publicKey);
        $io->success('Your keys have been generated!');
        $io->success('Done!');
    }

    private function handleExistingKeys(InputInterface $input): void
    {
        if (true === $input->getOption('skip-if-exists') && true === $input->getOption('overwrite')) {
            throw new \RuntimeException('Both options `--skip-if-exists` and `--overwrite` cannot be combined.', 1);
        }

        if (true === $input->getOption('skip-if-exists')) {
            throw new \RuntimeException('Your key files already exist, they won\'t be overriden.', 0);
        }

        if (false === $input->getOption('overwrite')) {
            throw new \RuntimeException('Your keys already exist. Use the `--overwrite` option to force regeneration.', 1);
        }
    }

    private function generateKeyPair($passphrase): array
    {
        $config = [
            'digest_alg' => 'sha256',
            'private_key_type' => \OPENSSL_KEYTYPE_RSA,
            'private_key_bits' => 2048,
        ];

        $resource = \openssl_pkey_new($config);
        if (false === $resource) {
            throw new \RuntimeException(\openssl_error_string());
        }

        $success = \openssl_pkey_export($resource, $privateKey, $passphrase);

        if (false === $success) {
            throw new \RuntimeException(\openssl_error_string());
        }

        $publicKeyData = \openssl_pkey_get_details($resource);

        if (false === $publicKeyData) {
            throw new \RuntimeException(\openssl_error_string());
        }

        $publicKey = $publicKeyData['key'];

        return [$privateKey, $publicKey];
    }

}
