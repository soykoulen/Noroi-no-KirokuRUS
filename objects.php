<?php
// objects.php
require_once 'includes/config.php';
include 'includes/header.php';

try {
    $stmt = $pdo->query("SELECT id, object_name, `desc` FROM object ORDER BY object_name");
    $objects = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}
?>

<h2>Каталог проклятых объектов и мест</h2>
<p>Всего записей: <?php echo count($objects); ?></p>

<div class="catalog-grid">
    <?php foreach ($objects as $object): ?>
        <div class="card">
            <h3><a href="object.php?id=<?php echo $object['id']; ?>"><?php echo htmlspecialchars($object['object_name']); ?></a></h3>
            <p><?php echo htmlspecialchars(mb_substr($object['desc'], 0, 100)) . '...'; ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'includes/footer.php';
?>