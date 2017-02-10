<?php

namespace Kanboard\Plugin\Organizations\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
	$pdo->exec("
		ALTER TABLE tasks ADD COLUMN (organization varchar(255))
	");
}

