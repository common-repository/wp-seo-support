<table class="form-table keyword-table">
    <thead>
        <tr>
            <th class="column-10">No.</th>
            <th class="column-30">キーワード</th>
            <th class="column-30">出現回数</th>
            <th class="column-30">出現率</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($this->keywords as $word) {
            // キーワード30個まで表示
            if ($i > 30) {
                break;
            }
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $word['word']; ?></td>
                <td><?php echo $word['count']; ?></td>
                <?php $ratio = round($word['count'] / $this->count * 100, 2); ?>
                <td><?php echo $ratio; ?>%</td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </tbody>
</table>