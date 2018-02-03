<?php
require_once 'vendor/autoload.php';
require_once 'Math/Question.php';

function make_a_doc($filename)
{
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();

    $titleStyle = 'titleStyle';
    $phpWord->addFontStyle(
        $titleStyle,
        array('name' => 'Tahoma', 'size' => 22, 'color' => '1B2232', 'bold' => true)
    );

    $qStyle = 'qStyle';
    $phpWord->addFontStyle(
        $qStyle,
        array('name' => 'Tahoma', 'size' => 18)
    );

    $section->addText(
        "Time:                    ",
        $titleStyle
    );
    $section->addText("\r\n");

    $type = \Math\Question::TYPE_ADD_SUB;
    $range = 99;
    $q = new \Math\Question($range, $type);

    for ($i = 0; $i < 25; $i++) {
        $line = '';
        for ($j = 0; $j < 4; $j++) {
            $line .= $q->generate();
            $line .= '       ' . "\t";
        }
        $section->addText($line, $qStyle);
        $section->addText("\r\n");
    }

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filename);

    $objWrite  = null;
    $phpword   = null;
}


for ($i = 1; $i <= 20; $i++) {
    $filename = "q$i.doc";
    make_a_doc($filename);
}
