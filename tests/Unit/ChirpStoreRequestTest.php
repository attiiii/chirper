<?php

namespace Tests\Unit;

use App\Http\Requests\ChirpStoreRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ChirpStoreRequestTest extends TestCase
{
    /**
     * @test
     * @dataProvider validationProvider
     */
    public function test_validation(array $data, bool $expected, array $errorMessages)
    {
        $request = new ChirpStoreRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        $this->assertSame($expected, $validator->passes());
        $this->assertSame($errorMessages, $validator->errors()->getMessages());
    }

    public function validationProvider()
    {
        return [
            'success' => [
                [
                    'message' => 'This Chirp can be stored.'
                ],
                true,
                [],
            ],
            'success file upload' => [
                [
                    'message' => 'This Chirp can be stored.',
                    'file' => UploadedFile::fake()->image('attachment.jpg')->size(5120)
                ],
                true,
                [],
            ],
            'empty message' => [
                [
                    'message' => ''
                ],
                false,
                [
                    'message' => ['The message field is required.']
                ],
            ],
            'empty field' => [
                [],
                false,
                [
                    'message' => ['The message field is required.']
                ],
            ],
            'too long message' => [
                [
                    'message' => 'NuJfnRrvSqDx3u8JTjsFwXmv1Rk2vbhNKSjURgORR46wKrTjC1R0Ro3IC06uhWyddgD7BSyRgoPBSbwLUYDDNIyVamQq8Bif6P0NSUcWPRSWvCwkgVY3t4kV8J2WYkw1APlQFOScnWHivmIFtAKa3uid3vRjTWDeMN76cvHQ72OLCaB2MqwKJqbteeYTQYrvJ4Urm5JFciBknttkkrXMdfioTxDmYoNQRbQaIvaiY412IuWhYhOb2rYkHiHqnlac'
                ],
                false,
                [
                    'message' => ['The message must not be greater than 255 characters.']
                ],
            ],
            'wrong file extension' => [
                [
                    'message' => 'This Chirp can be stored.',
                    'file' => UploadedFile::fake()->image('attachment.gif')
                ],
                false,
                [
                    'file' => ['The file must be a file of type: png, jpg.']
                ],
            ],
            'too large file size' => [
                [
                    'message' => 'This Chirp can be stored.',
                    'file' => UploadedFile::fake()->image('attachment.jpg')->size(5121)
                ],
                false,
                [
                    'file' => ['The file must not be greater than 5120 kilobytes.']
                ],
            ]
        ];
    }
}
