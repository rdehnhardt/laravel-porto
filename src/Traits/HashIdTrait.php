<?php

namespace Porto\Traits;

use Vinkla\Hashids\Facades\Hashids;
use Route;

trait HashIdTrait
{
    /**
     * @var  array
     */
    private $skippedEndpoints = [
    ];

    /**
     * Hashes the value of a field
     *
     * @return  mixed
     */
    public function getHashedKey()
    {
        $value = $this->getAttribute($this->getKeyName());

        return $this->encoder($value);
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    private function decoder($id)
    {
        return Hashids::decode($id);
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function encoder($id)
    {
        return Hashids::encode($id);
    }

    /**
     * Automatically decode id in URL.
     */
    public function routeHashedIdsDecoder()
    {
        Route::bind('id', function ($id, $route) {
            if (!in_array($route->uri(), $this->skippedEndpoints)) {
                $decoded = $this->decoder($id);

                if (empty($decoded)) {
                    throw new IncorrectIdException("ID ($id) is incorrect, consider using the hashed ID instead of the numeric ID.");
                }
                return $decoded[0];
            }
        });
    }
}