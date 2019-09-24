<?php

namespace Porto\Traits;

class CallableTrait
{
    /**
     * This function will be called from anywhere (controllers, Actions,..) by the Apiato facade.
     * The $class input will usually be an Action or Task.
     *
     * @param       $class
     * @param array $runMethodArguments
     * @param array $extraMethodsToCall
     *
     * @return  mixed
     * @throws \Dto\Exceptions\UnstorableValueException
     */
    public function call($class, $runMethodArguments = [], $extraMethodsToCall = [])
    {
        $class = $this->resolveClass($class);

        $this->callExtraMethods($class, $extraMethodsToCall);
        // detects Requests arguments "usually sent by controllers", and cvoert them to Transporters.
        $runMethodArguments = $this->convertRequestsToTransporters($class, $runMethodArguments);
        return $class->run(...$runMethodArguments);
    }

}
