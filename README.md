<h1>Endpoints</h1>

<h3><strong>GET</strong> api/itens</h3>
<p>Retorna todos os itens</p>

<h3><strong>GET</strong> api/itens/id</h3>
<p>Retorna um item especifico pelo id</p>

<h3><strong>POST</strong> api/itens</h3>
<p>Adicionando itens no banco de dados</p>
<h4>Parametros</h4>
<ul>
<li>codigo</li>
<li>nome</li>
<li>tipo</li>
<li>valor-un-compra</li>
<li>valor-un-venda</li>
<li>estoque-gerado</li>
<li>estoque-disponivel</li>
<li>entradas</li>
<li>saidas</li>
<li>perca</li>
</ul>
<p>EX: {"nome":"nome do produto"}</p>

<h3><strong>PUT</strong> api/itens/id</h3>
<p>Altera os dados no banco, conforme os parametros passados.</p>
<h4>Parametros</h4>
<ul>
<li>codigo</li>
<li>nome</li>
<li>tipo</li>
<li>valor-un-compra</li>
<li>valor-un-venda</li>
<li>estoque-gerado</li>
<li>estoque-disponivel</li>
<li>entradas</li>
<li>saidas</li>
<li>perca</li>
</ul>
<p>EX: {"nome":"novo nome"}</p>

<h3><strong>DELETE</strong> api/itens/id</h3>
<p>Deleta o item com o Id passado.</p>

<h3><strong>POST</strong> api/itens/namesearch</h3>
<p>Filtra pelo nome</p>
<h4>Parametros obrigatorio</h4>
<ul>
<li>nome</li>
</ul>
<p>EX: {"nome":"pesquisa"}</p>

<h3><strong>POST</strong> api/itens/tiposearch</h3>
<p>Filtra pelo tipo do item</p>
<h4>Parametros obrigatorio</h4>
<ul>
<li>tipo</li>
</ul>
<p>EX: {"tipo":"pesquisa"}</p>

<h3><strong>POST</strong> api/itens/codigosearch</h3>
<p>Filtra pelo codigo do item</p>
<h4>Parametros obrigatorio</h4>
<ul>
<li>tipo</li>
</ul>
<p>EX: {"codigo":"codigo do item"}</p>


