<?php
// object.php
require_once 'includes/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: objects.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM object WHERE id = ?");
    $stmt->execute([$id]);
    $object = $stmt->fetch();

    if (!$object) {
        header('Location: objects.php');
        exit;
    }

    // Получаем историю объекта
    $story = null;
    if (!empty($object['story_id_o'])) {
        $stmtStory = $pdo->prepare("SELECT o_story_name, story FROM object_story WHERE id = ?");
        $stmtStory->execute([$object['story_id_o']]);
        $story = $stmtStory->fetch();
    }

} catch (PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}

include 'includes/header.php';
?>

<h2><?php echo htmlspecialchars($object['object_name']); ?></h2>

<div class="detail-block">
    <h3>Описание</h3>
    <p><?php echo nl2br(htmlspecialchars($object['desc'])); ?></p>
</div>

<?php if ($story): ?>
    <hr>
    <div class="detail-block">
        <h3>Легенда: <?php echo htmlspecialchars($story['o_story_name']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($story['story'])); ?></p>
    </div>
<?php endif; ?>

<p><a href="objects.php">← Вернуться к каталогу объектов</a></p>

<?php
include 'includes/footer.php';
?>