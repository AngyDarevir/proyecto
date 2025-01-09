<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet" />
    <title>Datos fiscales</title>
</head>
<body>
<nav>
            <ul>
                <li><a href="dashboardAdmin.php">Dashboard</a></li>
                <li><a href="dashboardSuscripcionesAdmin.php">Dashboard de Suscripciones</a></li>
                <li><a href="usuariosAdmin.php">Usuarios</a></li>
                <li><a href="perfilAdministrador.php">Perfil de Administrador</a></li>
                <li><a href="cupones.php">Cupones</a></li>
                <li><a href="planesAdmin.php">Planes</a></li>
                <li>
                    <form action="../controladores/logout.php" method="post">
                        <input type="submit" value="Cerrar sesión" class="btn">
                </li>
                </form>
        </nav>
        <br></br>
<div class="datosf">
        <h1>Datos fiscales</h1>
        <form action="conexionDB.php" method="post">
            <label for="razonfiscal">
                <i class="fas fa-razonfisc"></i>
            </label>
            <h4>Razon fiscal</h4>
            <input type="text" name="razonfis"
                placeholder="Razon social" id="razonfi" required>
            <label for="rfc">
                <i class="fas fa-rfc"></i>
            </label>
            <h4>RFC</h4>
            <input type="text" name="rfc"
                placeholder="RFC" id="rfc" required>
            <br><br>
            <label for="regimenf">
                <i class="fas fa-regimenf"></i>
            </label>
            <h4>Regimen fiscal</h4>
            <input type="text" name="regimenf"
                placeholder="Regimen Fiscal" id="regimenf" required>
                <select name="mregimenf">
                <option>601</option>
                <option>603</option>
                <option>605</option>
                <option>606</option>
                <option>607</option>
                <option>608</option>
                <option>609</option>
                <option>610</option>
                <option>611</option>
                <option>612</option>
                <option>614</option>
                <option>615</option>
                <option>616</option>
                <option>620</option>
                <option>621</option>
                <option>622</option>
                <option>623</option>
                <option>624</option>
                <option>625</option>
                <option>626</option>
                <option>628</option>
                <option>629</option>
                <option>630</option>
            </select>
            <label for="calle">
                <i class="fas fa-calle"></i>
            </label>
            <h4>Calle</h4>
            <input type="text" name="calle"
                placeholder="Calle" id="calle" required>
            <label for="num_ext">
                <i class="fas fa-numext"></i>
            </label>
            <h4>Numero exterior</h4>
            <input type="text" name="numext"
                placeholder="Numero exterior" id="numext" required>
            <br><br>
            <label for="numint">
                <i class="fas fa-numint"></i>
            </label>
            <h4>Numero interior</h4>
            <input type="text" name="numint"
                placeholder="Numero interior" id="numint" required>
            <label for="codigopos">
                <i class="fas fa-codigopos"></i>
            </label>
            <h4>Codigo postal</h4>
            <input type="text" name="codigopos"
                placeholder="Codigo portal fiscal" id="codigop" required>
            <label for="colonia">
                <i class="fas fa-colonia"></i>
            </label>
            <h4>Colonia</h4>
            <input type="text" name="colonia"
                placeholder="Colonia" id="colonia" required>
            <br><br>
            <label for="pais">
                <i class="fas fa-pais"></i>
            </label>
            <h4>País</h4>
            <input type="text" name="pais"
                placeholder="Pais" id="paiss" required>
                <select name="pais">
                <option>AD</option>
                <option>AE</option>
                <option>AF</option>
                <option>AG</option>
                <option>AI</option>
                <option>AL</option>
                <option>AM</option>
                <option>AO</option>
                <option>AQ</option>
                <option>AR</option>
                <option>AS</option>
                <option>AT</option>
                <option>AU</option>
                <option>A</option>
                <option>AX</option>
                <option>AZ</option>
                <option>BA</option>
                <option>BB</option>
                <option>BD</option>
                <option>BE</option>
                <option>BF</option>
                <option>BG</option>
                <option>BH</option>
                <option>BI</option>
                <option>BJ</option>
                <option>BL</option>
                <option>BM</option>
                <option>BN</option>
                <option>BO</option>
                <option>BQ</option>
                <option>BR</option>
                <option>BS</option>
            </select>
            <label for="estado">
                <i class="fas fa-estado"></i>
            </label>
            <h4>Estado</h4>
            <input type="text" name="estado"
                placeholder="Estado" id="estado" required>
                <select name="Estado">
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
                <option>32</option>
            </select>
            <label for="municipio">
                <i class="fas fa-municipio"></i>
            </label>
            <h4>Municipio</h4>
            <input type="text" name="municipio"
                placeholder="Municipio" id="munici" required>
            <br><br>
            <button> Actualizar</button>
            <button><a href="perfilCliente.php">Cambiar datos generales</a></button>
        </form>
    </div>    
</body>
</html>