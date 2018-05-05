<style>
table {
    border-spacing: 1;
    border-collapse: collapse;
    background: white;
    overflow: hidden;
    margin: 0 auto;
    text-align: center;
    color: #151515;
  border: 1px solid #36304a;
}
table thead tr {height: 60px;background-color: #36304a;color:#fff;}
table tbody tr {height: 30px;}
table tbody tr:nth-child(odd) {background-color:#eaeaea;}
table tbody tr:hover {background-color:#bce6bd;}
table thead tr td,table tbody tr td {padding: 8px 15px;}
</style>

<table>
  <thead>
    <tr>
      <th>DAY</th>
      <th>MONTH</th> 
      <th>YEAR</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($d as $v): ?>
      <tr>
        <td><?php echo $v['day'] ?></td>
        <td><?php echo $v['month'] ?></td>
        <td><?php echo $v['year'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>