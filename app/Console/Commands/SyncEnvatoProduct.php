<?php

namespace App\Console\Commands;

use App\Enums\ProductProvider;
use App\Models\Product;
use App\Services\Envato\Client;
use App\Settings\EnvatoSettings;
use Illuminate\Console\Command;

class SyncEnvatoProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envato:sync-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync product from Envato through API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Client $client)
    {
        $envatoSites = ['themeforest', 'codecanyon', 'videohive', 'audiojungle', 'graphicriver', 'photodune', '3docean', 'activeden'];
        $envatoSettings = app(EnvatoSettings::class);
        if (! $envatoSettings->token_enabled || ! $envatoSettings->account_token) {
            $this->info('Envato personal token is not enabled or not set.');
            return 0;
        }
        $bar = $this->output->createProgressBar(count($envatoSites));
        $bar->start();
        try {
            foreach ($envatoSites as $site) {
                $this->newLine();
                $this->info('Starting ' . \Str::ucfirst($site) . '\'s product synchronization...');
                $response = $client->getNewItems($envatoSettings->account_token, $envatoSettings->account_username, $site);
                $items = $response['new-files-from-user'];
                $this->info(trans_choice('Found :count product!|Found :count products!', count($items)));
                foreach ($items as $item) {
                    $this->info('Working on [' . $item['item'] . ']...');
                    $product = Product::firstOrCreate([
                        'provider' => ProductProvider::ENVATO->name,
                        'code' => $item['id'],
                    ]);
                    $product->name = $item['item'];
                    $product->meta = $item;
                    $product->save();
                    $product->addMediaFromUrl($item['thumbnail'])->toMediaCollection('logo');
                }
                $bar->advance();
            }
        } catch (\Exception $e) {
            logger($e);
        }
        $bar->finish();
    }
}
