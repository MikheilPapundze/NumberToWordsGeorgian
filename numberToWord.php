<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $single_digits = array("ნული", "ერთი", "ორი", "სამი", "ოთხი", "ხუთი", "ექვსი", "შვიდი", "რვა", "ცხრა");
    $eleven_twenty = array("ათი", "თერთმეტი", "თორმეტი", "ცამეტი", "თოთხმეტი", "თხუთმეტი", "თექვსმეტი", "ჩვიდმეტი", "თვრამეტი", "ცხრამეტი");
    $two_digits = array(2 => "ოცი", 4 => "ორმოცი", 6 => "სამოცი", 8 => "ოთხმოცი");
    $three_digits = array("", "ასი", "ორასი", "სამასი", "ოთხასი", "ხუთასი", "ექვსასი", "შვიდასი", "რვაასი", "ცხრაასი");

    function twoDigits($n)
    {
        global $single_digits, $eleven_twenty, $two_digits, $three_digits;
        if ($n < 20) {
            return $eleven_twenty[$n % 10];
        } else {
            if ($n % 10 == 0) {
                if (($n / 10) % 2 == 0) {
                    return $two_digits[$n / 10];
                } else {
                    return mb_substr($two_digits[($n / 10) - 1], 0, -1) . "და" . $eleven_twenty[0];
                }
            } else {
                if ((intval($n / 10)) % 2 == 0) {
                    return mb_substr($two_digits[($n / 10)], 0, -1) . "და" . $single_digits[substr($n, 1)];
                } else {
                    return mb_substr($two_digits[($n / 10) - 1], 0, -1) . "და" . $eleven_twenty[$n % 10];
                }
            }
        }
    }

    function threeDigits($n)
    {
        global $single_digits, $three_digits;
        if ($n % 100 == 0) {
            return $three_digits[$n / 100];
        } else {
            if (substr($n, 1)[0] == 0) {
                return mb_substr($three_digits[intval($n / 100)], 0, -1) . $single_digits[$n % 100];
            } else {
                return mb_substr($three_digits[intval($n / 100)], 0, -1) . twoDigits($n % 100);
            }
        }
    }

    $n = "200745";
    

    $n = intval($n);
    $len = strlen($n);

    if ($len == 1) {
        echo  $single_digits[$n];
    }

    if ($len == 2) {
        echo twoDigits($n);
    }

    if ($len == 3) {
        echo threeDigits($n);
    }

    if ($len > 3) {
        if ($n % 1000 == 0) {
            if (strlen($n / 1000) == 1) {
                if ($n / 1000 == 1) {
                    echo "ათასი";
                } else {
                    echo $single_digits[$n / 1000] . "ათასი";
                }
            } else if (strlen($n / 1000) == 2) {
                echo twoDigits($n / 1000) . "ათასი";
            } else if (strlen($n / 1000) == 3) {
                echo threeDigits($n / 1000) . "ათასი";
            }
        } else {
            if (strlen(intval($n / 1000)) == 1) {
                if (strlen(intval(substr($n, 1))) == 1) {
                    if (intval($n / 1000) == 1) {
                        echo "ათას" . $single_digits[intval(substr($n, 1))];
                    } else {
                        echo $single_digits[intval($n / 1000)] . "ათას " . $single_digits[intval(substr($n, 1))];
                    }
                } else if (strlen(intval(substr($n, 1))) == 2) {
                    if (intval($n / 1000) == 1) {
                        echo "ათას " . twoDigits(intval(substr($n, 1)));
                    } else {
                        echo $single_digits[intval($n / 1000)] . "ათას " . twoDigits(intval(substr($n, 1)));
                    }
                } else if (strlen(intval(substr($n, 1))) == 3) {
                    if (intval($n / 1000) == 1) {
                        echo "ათას " . threeDigits(intval(substr($n, 1)));
                    } else {
                        echo $single_digits[intval($n / 1000)] . "ათას " . threeDigits(intval(substr($n, 1)));
                    }
                }
            } else if (strlen(substr($n, 0, -3)) == 2) {
                if (strlen(intval(substr($n, 2))) == 1) {
                    echo twoDigits(intval($n / 1000)) . "ათას " . $single_digits[intval(substr($n, 2))];
                } else if (strlen(intval(substr($n, 2))) == 2) {
                    echo twoDigits(intval($n / 1000)) . "ათას " . twoDigits(intval(substr($n, 2)));
                } else if (strlen(intval(substr($n, 2))) == 3) {
                    echo twoDigits(intval($n / 1000)) . "ათას " . threeDigits(intval(substr($n, 2)));
                }
            } else if (strlen(substr($n, 0, -3)) == 3) {
                if (strlen(intval(substr($n, 3))) == 1) {
                    echo threeDigits(intval($n / 1000)) . "ათას " . $single_digits[intval(substr($n, 3))];
                } else if (strlen(intval(substr($n, 3))) == 2) {
                    echo threeDigits(intval($n / 1000)) . "ათას " . twoDigits(intval(substr($n, 3)));
                } else if (strlen(intval(substr($n, 3))) == 3) {
                    echo threeDigits(intval($n / 1000)) . "ათას " . threeDigits(intval(substr($n, 3)));
                }
            }
        }
    }
    



    ?>
</body>

</html>