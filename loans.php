<?php

namespace Artemis;

require_once __DIR__ . '/src/entity/Loan.php';

use Artemis\Loan;

$loans = Loan::getAllLoans();
$today = date("Y-m-d");

$inProgress = [];
$toReturn = [];
$isBack = [];

foreach ($loans as $loan) {
    $loanStatus = $loan['LoanStatus'];
    $loanEndDate = $loan['LoanEndDate'];

    if ($loanStatus == 0) {
        if ($today <= $loanEndDate) {
            $inProgress[] = $loan;
        } else {
            $toReturn[] = $loan;
        }
    } else {
        $isBack[] = $loan;
    }
}

$loanStatus = [
    ['label' => 'En cours', 'color' => 'indigo',],
    ['label' => 'À rendre', 'color' => 'red',],
    ['label' => 'Rendu', 'color' => 'green',]
];

include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/hero-loans.php';

?>

<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="flex flex-wrap -m-4">
            <?php
            for ($i = 0; $i < 3; $i++) {
                $title = $loanStatus[$i]['label'];
                $color = $loanStatus[$i]['color'];
                $array = ($i === 0) ? $inProgress : (($i === 1) ? $toReturn : $isBack);
                include __DIR__ . '/templates/_partials/loans_column.php';
            }
            ?>
        </div>
    </div>
</section>

<?php

include __DIR__ . '/templates/footer.php';
