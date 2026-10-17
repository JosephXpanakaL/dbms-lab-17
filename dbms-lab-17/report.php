<?php
require 'db.php';
$sql = 'SELECT customer.name AS customer_name, car.model, car.reg_no, rental.start_date, rental.end_date FROM rental INNER JOIN customer ON rental.customer_id = customer.customer_id INNER JOIN car ON rental.car_id = car.car_id ORDER BY rental.rental_id DESC';
$result = mysqli_query($conn, $sql);
if (!$result) { die('Report query failed: ' . htmlspecialchars(mysqli_error($conn))); }
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Rental Report</title><link rel="stylesheet" href="style.css"></head><body><main class="wide"><h1>Car Rental Report</h1><p class="sub">Rental records from customer, car and rental tables</p><div class="table-wrap"><table><thead><tr><th>Customer Name</th><th>Car Model</th><th>Registration No</th><th>Start Date</th><th>End Date</th></tr></thead><tbody>
<?php if (mysqli_num_rows($result) === 0): ?><tr><td colspan="5">No rentals yet. Add a rental on the entry page.</td></tr><?php else: ?><?php while ($row = mysqli_fetch_assoc($result)): ?><tr><td><?= htmlspecialchars($row['customer_name']) ?></td><td><?= htmlspecialchars($row['model']) ?></td><td><?= htmlspecialchars($row['reg_no']) ?></td><td><?= htmlspecialchars($row['start_date']) ?></td><td><?= htmlspecialchars($row['end_date']) ?></td></tr><?php endwhile; ?><?php endif; ?>
</tbody></table></div><a href="rental.php">← Back to Rental Entry</a></main></body></html>
