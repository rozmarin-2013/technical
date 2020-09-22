<?php
declare(strict_types=1);

namespace Task2;


/**
 * Class TestStrupa
 * @package Task2
 */
class TestStrupa
{
    /**
     * @var array
     */
    private array $arrayColors;
    /**
     * @var array|int[]
     */
    private array $size = [
        'cols' => 0,
        'rows' => 0
    ];

    /**
     * TestStrupa constructor.
     * @param array $arrayColors
     */
    public function __construct(array $arrayColors)
    {
        $this->arrayColors = $arrayColors;
    }

    /**
     * @return array
     */
    private function fillArrBySize()
    {
        $result = $this->arrayColors;
        $sizeArray = $this->getSizeArray();
        while (count($result) < $sizeArray) {
            $result = array_merge($result, $this->arrayColors);
        }

        $diffResultAndColorArr = count($result) - $sizeArray;

        if ($diffResultAndColorArr > 0) {
            $result = array_slice($result, 0, -1 * $diffResultAndColorArr);
        }

        return $result;
    }

    /**
     * @param array $colors
     * @param array $words
     * @return array
     */
    private function getStrupArr(array $colors, array $words): array
    {
        $result = [];
        $countArrColor = count($this->arrayColors);

        foreach ($colors as $key => $color) {
            $result[] = $this->getDifferentClrAndWord($color, $words, $key);
        }

        return $result;
    }

    /**
     * @param string $color
     * @param array $words
     * @param int|int $key
     * @return array
     */
    private function getDifferentClrAndWord(string $color, array $words, ?int $key): array
    {
       // $key = $key ?? 0;
        while ($color === $words[$key]) {
            $key++;
        }
        return [
            'word' => $words[$key],
            'color' => $color
        ];
    }

    /**
     * @return int
     */
    private function getSizeArray():int
    {
        $cols = $this->size['cols'];
        $rows = $this->size['rows'];
        $size = ($cols * $rows);

        return $size;
    }

    /**
     * @param int $rows
     * @param int $cols
     * @return array
     */
    public function getColorWords(int $rows, int $cols): array
    {
        list($this->size['cols'], $this->size['rows']) = [$cols, $rows];
        $colors = $this->fillArrBySize();
        $words = $this->fillArrBySize();
        shuffle($colors);
        shuffle($words);
        return $this->getStrupArr($colors, $words);
    }
}