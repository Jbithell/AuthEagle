<?php
// New Word Document
require_once 'libs/PHPWord/src/PhpWord/Autoloader.php';

date_default_timezone_set('UTC');

/**
 * Header file
 */
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

error_reporting(E_ALL);
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

Autoloader::register();
Settings::loadConfig();

// Set writers
$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');

// Set PDF renderer
if (null === Settings::getPdfRendererPath()) {
    $writers['PDF'] = null;
}

// Return to the caller script when runs by CLI
if (CLI) {
    return;
}

// Set titles and names
$pageHeading = str_replace('_', ' ', SCRIPT_FILENAME);
$pageTitle = IS_INDEX ? 'Welcome to ' : "{$pageHeading} - ";
$pageTitle .= 'PHPWord';
$pageHeading = IS_INDEX ? '' : "<h1>{$pageHeading}</h1>";

// Populate samples
$files = '';
if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle))) {
        if (preg_match('/^Sample_\d+_/', $file)) {
            $name = str_replace('_', ' ', preg_replace('/(Sample_|\.php)/', '', $file));
            $files .= "<li><a href='{$file}'>{$name}</a></li>";
        }
    }
    closedir($handle);
}

/**
 * Write documents
 *
 * @param \PhpOffice\PhpWord\PhpWord $phpWord
 * @param string $filename
 * @param array $writers
 *
 * @return string
 */
function write($phpWord, $filename, $writers)
{
    $result = '';

    // Write documents
    foreach ($writers as $format => $extension) {
        $result .= date('H:i:s') . " Write to {$format} format";
        if (null !== $extension) {
            $targetFile = __DIR__ . "/results/{$filename}.{$extension}";
            $phpWord->save($targetFile, $format);
        } else {
            $result .= ' ... NOT DONE!';
        }
        $result .= EOL;
    }

    $result .= getEndingNotes($writers);

    return $result;
}

/**
 * Get ending notes
 *
 * @param array $writers
 *
 * @return string
 */
function getEndingNotes($writers)
{
    $result = '';

    // Do not show execution time for index
    if (!IS_INDEX) {
        $result .= date('H:i:s') . " Done writing file(s)" . EOL;
        $result .= date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB" . EOL;
    }

    // Return
    if (CLI) {
        $result .= 'The results are stored in the "results" subdirectory.' . EOL;
    } else {
        if (!IS_INDEX) {
            $types = array_values($writers);
            $result .= '<p>&nbsp;</p>';
            $result .= '<p>Results: ';
            foreach ($types as $type) {
                if (!is_null($type)) {
                    $resultFile = 'results/' . SCRIPT_FILENAME . '.' . $type;
                    if (file_exists($resultFile)) {
                        $result .= "<a href='{$resultFile}' class='btn btn-primary'>{$type}</a> ";
                    }
                }
            }
            $result .= '</p>';
        }
    }

    return $result;
}




$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();
$header = array('size' => 16, 'bold' => true);

// 1. Basic table

$rows = 10;
$cols = 5;
$section->addText(htmlspecialchars('Basic table'), $header);

$table = $section->addTable();
for ($r = 1; $r <= 8; $r++) {
    $table->addRow();
    for ($c = 1; $c <= 5; $c++) {
        $table->addCell(1750)->addText(htmlspecialchars("Row {$r}, Cell {$c}"));
    }
}

// 2. Advanced table

$section->addTextBreak(1);
$section->addText(htmlspecialchars('Fancy table'), $header);

$styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
$styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
$styleCell = array('valign' => 'center');
$styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
$fontStyle = array('bold' => true, 'align' => 'center');
$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
$table = $section->addTable('Fancy Table');
$table->addRow(900);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 1'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 2'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 3'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Row 4'), $fontStyle);
$table->addCell(500, $styleCellBTLR)->addText(htmlspecialchars('Row 5'), $fontStyle);
for ($i = 1; $i <= 8; $i++) {
    $table->addRow();
    $table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
    $table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
    $table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
    $table->addCell(2000)->addText(htmlspecialchars("Cell {$i}"));
    $text = (0== $i % 2) ? 'X' : '';
    $table->addCell(500)->addText(htmlspecialchars($text));
}

// 3. colspan (gridSpan) and rowspan (vMerge)

$section->addPageBreak();
$section->addText(htmlspecialchars('Table with colspan and rowspan'), $header);

$styleTable = array('borderSize' => 6, 'borderColor' => '999999');
$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFF00');
$cellRowContinue = array('vMerge' => 'continue');
$cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
$cellHCentered = array('align' => 'center');
$cellVCentered = array('valign' => 'center');

$phpWord->addTableStyle('Colspan Rowspan', $styleTable);
$table = $section->addTable('Colspan Rowspan');

$table->addRow();

$cell1 = $table->addCell(2000, $cellRowSpan);
$textrun1 = $cell1->addTextRun($cellHCentered);
$textrun1->addText(htmlspecialchars('A'));
$textrun1->addFootnote()->addText(htmlspecialchars('Row span'));

$cell2 = $table->addCell(4000, $cellColSpan);
$textrun2 = $cell2->addTextRun($cellHCentered);
$textrun2->addText(htmlspecialchars('B'));
$textrun2->addFootnote()->addText(htmlspecialchars('Colspan span'));

$table->addCell(2000, $cellRowSpan)->addText(htmlspecialchars('E'), null, $cellHCentered);

$table->addRow();
$table->addCell(null, $cellRowContinue);
$table->addCell(2000, $cellVCentered)->addText(htmlspecialchars('C'), null, $cellHCentered);
$table->addCell(2000, $cellVCentered)->addText(htmlspecialchars('D'), null, $cellHCentered);
$table->addCell(null, $cellRowContinue);

// 4. Nested table

$section->addTextBreak(2);
$section->addText(htmlspecialchars('Nested table in a centered and 50% width table.'), $header);

$table = $section->addTable(array('width' => 50 * 50, 'unit' => 'pct', 'align' => 'center'));
$cell = $table->addRow()->addCell();
$cell->addText(htmlspecialchars('This cell contains nested table.'));
$innerCell = $cell->addTable(array('align' => 'center'))->addRow()->addCell();
$innerCell->addText(htmlspecialchars('Inside nested table'));

// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writers);
