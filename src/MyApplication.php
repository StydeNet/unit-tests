<?php

namespace Styde;

class MyApplication extends Application
{

    protected function registerAccessHandler()
    {
        exit('Custom access handler');
    }

}