<?php
namespace Utils;

class ArraysTest extends \CustomPHPUnitTestCase
{
    public function testFnisAssoc()
    {
        $is_array = Arrays::isAssoc(['item1', 'item2', 'item3']);
        $this->assertEquals($is_array, false);

        $is_array = Arrays::isAssoc(['attr1' => 'item1', 'attr2' => 'item2', 'attr2' => 'item3']);
        $this->assertEquals($is_array, true);
    }

    public function testNormalizeFilesArray()
    {
        // images[]
        $files = [
            'images' => [
                'name' => [
                    'test1.jpg',
                    'test2.jpg',
                    null,
                ],
                'type' => [
                    'image/jpeg',
                    'image/jpeg',
                    null,
                ],
                'tmp_name' => [
                    '/tmp/nsl54Gs',
                    '/tmp/1sl54GC',
                    null,
                ],
                'error' => [
                    0,
                    0,
                    4,
                ],
                'size' => [
                    1715,
                    5368,
                    0,
                ],
            ],
        ];

        $normalize_files = [
            'images' => [
                [
                    'name' => 'test1.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/nsl54Gs',
                    'error' => 0,
                    'size' => 1715,
                ],
                [
                    'name' => 'test2.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/1sl54GC',
                    'error' => 0,
                    'size' => 5368,
                ],
            ],
        ];

        $normalize_array = Arrays::normalizeFilesArray($files);
        $this->assertEquals($normalize_array, $normalize_files);
    }

    public function testNormalizeFilesArrayNested()
    {
        // images[files][]
        $files = [
            'images' => [
                'name' => [
                    'files' => [
                        'test1.jpg',
                        'test2.jpg',
                        null,
                    ],
                ],
                'type' => [
                    'files' => [
                        'image/jpeg',
                        'image/jpeg',
                        null,
                    ],
                ],
                'tmp_name' => [
                    'files' => [
                        '/tmp/nsl54Gs',
                        '/tmp/1sl54GC',
                        null,
                    ],
                ],
                'error' => [
                    'files' => [
                        0,
                        0,
                        4,
                    ],
                ],
                'size' => [
                    'files' => [
                        1715,
                        5368,
                        0,
                    ],
                ],
            ],
        ];

        $normalize_files = [
            'images' => [
                'files' => [
                    [
                        'name' => 'test1.jpg',
                        'type' => 'image/jpeg',
                        'tmp_name' => '/tmp/nsl54Gs',
                        'error' => 0,
                        'size' => 1715,
                    ],
                    [
                        'name' => 'test2.jpg',
                        'type' => 'image/jpeg',
                        'tmp_name' => '/tmp/1sl54GC',
                        'error' => 0,
                        'size' => 5368,
                    ],
                ],
            ],
        ];

        $normalize_array = Arrays::normalizeFilesArray($files);
        $this->assertEquals($normalize_array, $normalize_files);
    }

    public function testNormalizeFilesArrayWithCorrectArray()
    {
        // images[files][]
        $files = [
            'images' => [
                'files' => [
                    [
                        'name' => 'test1.jpg',
                        'type' => 'image/jpeg',
                        'tmp_name' => '/tmp/nsl54Gs',
                        'error' => 0,
                        'size' => 1715,
                    ],
                    [
                        'name' => 'test2.jpg',
                        'type' => 'image/jpeg',
                        'tmp_name' => '/tmp/1sl54GC',
                        'error' => 0,
                        'size' => 5368,
                    ],
                ],
            ],
        ];

        $normalize_files = [
            'images' => [
                'files' => [
                    [
                        'name' => 'test1.jpg',
                        'type' => 'image/jpeg',
                        'tmp_name' => '/tmp/nsl54Gs',
                        'error' => 0,
                        'size' => 1715,
                    ],
                    [
                        'name' => 'test2.jpg',
                        'type' => 'image/jpeg',
                        'tmp_name' => '/tmp/1sl54GC',
                        'error' => 0,
                        'size' => 5368,
                    ],
                ],
            ],
        ];

        $normalize_array = Arrays::normalizeFilesArray($files);
        $this->assertEquals($normalize_array, $normalize_files);
    }
}
