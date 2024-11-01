<table class="form-table correction-table">
    <thead>
        <tr>
            <th class="column-10">No.</th>
            <th class="column-30">対象表記</th>
            <th class="column-30">言い換え候補文字列</th>
            <th class="column-30">区分</th>
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
                <td><?php echo $word['surface']; ?></td>
                <td><?php echo $word['shiteki_word']; ?></td>
                <td><?php echo $word['shiteki_info']; ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </tbody>
</table>