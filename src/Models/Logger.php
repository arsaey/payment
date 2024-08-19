<?php

namespace Blognevis\Payments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * This file is part of the Laravel NOWPayments package.
 *
 * (c) Prevail Ejimadu <prevailexcellent@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Logger extends Model
{
  use HasFactory;

  protected $fillable = [
    'gateway', 'status', 'amount'
  ];
  protected $table = 'payment_logs';

}
