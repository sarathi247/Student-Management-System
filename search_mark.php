<?php
include "db_conn.php";

// Initialize search query
$search_query = "";
$search_result = [];

if (isset($_POST['search'])) {
    $search_query = $conn->real_escape_string($_POST['query']);

    // Search SQL Query (checks testno, studentid, and mark)
    $sql = "SELECT * FROM mark 
            WHERE testno LIKE '%$search_query%' 
            OR studentid LIKE '%$search_query%' 
            OR mark LIKE '%$search_query%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_result[] = $row;
        }
    } else {
        $message = "<h3 style='color:red; text-align:center;'>No records found!</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Marks</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { width: 50%; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        input[type="text"] { width: 80%; padding: 10px; margin-bottom: 10px; }
        button { padding: 10px 15px; background-color: green; color: white; border: none; cursor: pointer; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>

<div class="container">
    
    <form method="POST">
        <input type="text" name="query" placeholder="Search by Test No, Student ID, or Mark" value="<?php echo $search_query; ?>">
        <button type="submit" name="search">Search</button>
    </form>
</div>

<?php
// Display search results
if (!empty($search_result)) {
    echo "<table>
            <tr>
                <th>No</th>
                <th>Test No</th>
                <th>Student ID</th>
                <th>Mark</th>
            </tr>";
    foreach ($search_result as $row) {
        echo "<tr>
                <td>{$row['no']}</td>
                <td>{$row['testno']}</td>
                <td>{$row['studentid']}</td>
                <td>{$row['mark']}</td>
              </tr>";
    }
    echo "</table>";
} elseif (isset($message)) {
    echo $message;
}
?>

</body>
</html>
