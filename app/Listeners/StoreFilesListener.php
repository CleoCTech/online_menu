<?php

namespace App\Listeners;

use App\Models\Dish;
use App\Models\Restraunt;
use App\Models\TemporaryFile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class StoreFilesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (session()->has('files')) {
            foreach (session('files') as $i => $values) {

                Dish::where('id', $event->dishId)
                    ->update([
                        'folder' => $values['folder'],
                        'filename' => $values['filename'],
                    ]);

                $temporaryFile = TemporaryFile::where('folder', $values['folder'])->first();
                if ($temporaryFile) {
                    $restaurantName = Restraunt::where('id', auth()->user()->id)->first();
                    Storage::move('public/tmp/' .$values['folder']. '/' . $values['filename'], 'public/'.$restaurantName->code.'/' .$values['folder']. '/' . $values['filename']);
                        Storage::deleteDirectory('public/tmp/' .$values['folder'] );
                        $temporaryFile->delete();
                }
            }

        }
        session()->forget('files');
    }
}