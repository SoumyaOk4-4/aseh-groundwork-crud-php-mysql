<?php
require 'db.php';

// 1. CREATE: Handle adding a new student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO students (name, course) VALUES (:name, :course)");
    $stmt->execute([
        ':name' => $_POST['name'],
        ':course' => $_POST['course']
    ]);
    header("Location: index.php");
    exit;
}

// 2. UPDATE: Handle saving changes to an existing student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE students SET name = :name, course = :course WHERE id = :id");
    $stmt->execute([
        ':name' => $_POST['name'],
        ':course' => $_POST['course'],
        ':id' => $_POST['id']
    ]);
    header("Location: index.php");
    exit;
}

// 3. DELETE: Handle removing a student when "Delete" is clicked
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
    $stmt->execute([':id' => $_GET['delete']]);
    header("Location: index.php");
    exit;
}

// Check if "Edit" was clicked to pre-fill the form
$editStudent = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
    $stmt->execute([':id' => $_GET['edit']]);
    $editStudent = $stmt->fetch(PDO::FETCH_ASSOC);
}

// 4. READ: Fetch all students to display in the table
$students = $pdo->query("SELECT * FROM students ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Manager - PHP CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 40px auto; padding: 0 20px; }
        form { background: #f4f4f4; padding: 15px; border-radius: 5px; margin-bottom: 25px; }
        input { padding: 8px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 8px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        a { text-decoration: none; margin-right: 10px; }
    </style>
</head>
<body>

    <h2>Student Management System</h2>

    <!-- FORM FOR CREATE & UPDATE -->
    <form method="POST" action="index.php">
        <h3><?= $editStudent ? "Edit Student" : "Add New Student" ?></h3>
        
        <?php if ($editStudent): ?>
            <input type="hidden" name="id" value="<?= $editStudent['id'] ?>">
        <?php endif; ?>

        <input type="text" name="name" placeholder="Student Name" required 
               value="<?= $editStudent ? htmlspecialchars($editStudent['name']) : '' ?>">
        
        <input type="text" name="course" placeholder="Course Name" required 
               value="<?= $editStudent ? htmlspecialchars($editStudent['course']) : '' ?>">

        <?php if ($editStudent): ?>
            <button type="submit" name="update" style="background: #007bff;">Update</button>
            <a href="index.php">Cancel</a>
        <?php else: ?>
            <button type="submit" name="add">Add Student</button>
        <?php endif; ?>
    </form>

    <!-- TABLE FOR READ & DELETE -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['course']) ?></td>
            <td>
                <a href="index.php?edit=<?= $row['id'] ?>" style="color: #007bff;">Edit</a>
                <a href="index.php?delete=<?= $row['id'] ?>" style="color: #dc3545;" 
                   onclick="return confirm('Delete this student?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
