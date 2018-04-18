<?php

namespace App\Api\Enum;

interface DeviceMarkEnum {


    const DEVICE_IN = 0x0001;

    const DEVICE_OUT = 0x0002;

    const MESSAGE_IDENTIFY = 0x0003;

    const MESSAGE_HEART = 0x0004;

    const MESSAGE_AUDIO = 0x0005;

    const MESSAGE_TEXT = 0x0006;

    const MESSAGE_TEXT_ALL = 0x0007;

    const MESSAGE_AUDIO_ALL = 0x0008;


}