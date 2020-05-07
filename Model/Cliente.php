<?php

class Cliente extends Model
{
    protected $ultimo_pedido;

    public function autenticar(){
        try {
            $query = 'SELECT 
                            id,company_name
                        FROM 
                            cliente
                        WHERE 
                            email = ? AND
                            pass = ?';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(1, $this->__get('email'));
            $stmt->bindValue(2, $this->__get('pass'));
            $stmt->execute();
            $response =  $stmt->fetch(\PDO::FETCH_ASSOC);
            if(isset($response['id'])){
                $this->__set('id', $response['id']);
                $this->__set('company_name', $response['company_name']);
            }
            return $this;
        } catch (\PDOException $e) {
            echo $e;
        }
    }

    public function autenticar2(){
        try{
             $query = 'SELECT 
                         company_name
                     FROM 
                         cliente
                     WHERE 
                         id = ? AND
                         pass = ?';
             $stmt = $this->con->prepare($query);
             $stmt->bindValue(1,$this->__get('id'));
             $stmt->bindValue(2,$this->__get('pass'));
             $stmt->execute();
             return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
             echo $e;
        }
    }

    public function getMinhasInfos(){
        try{
            $query = "SELECT email, company_name, cnpj ,tel, tel_2 FROM cliente WHERE id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(1,$this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            echo '<p>'.$e->getMessage().'</p>';
        }
    }

    public function procurarCliente($desc){
        try{
            $query = "SELECT 
                            id,company_name,cnpj 
                        FROM 
                            cliente 
                        WHERE 
                            (company_name LIKE :comp) OR (cnpj = :cnpj)
                        ORDER BY
                            company_name";
            $stmt= $this->con->prepare($query);
            $stmt->bindValue(":comp",'%'.$desc.'%');
            $stmt->bindValue(":cnpj",$desc);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            echo '<p>'.$e->getMessage().'<\p>';
        }
    }

    public function getClientePorEmail(){
        try {
            $query = 'SELECT 
                            id
                        FROM 
                            cliente
                        WHERE 
                            email = ?';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(1, $this->__get('email'));
            $stmt->execute();
            $response = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $response;
        } catch (\PDOException $e) {
            echo $e;
        }
    }

    public function getClientePorCNPJ(){
        try {
            $query = 'SELECT 
                            id,company_name,cnpj
                        FROM 
                            cliente
                        WHERE 
                            cnpj = ?';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(1, $this->__get('cnpj'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e;
        }
    }

    public function cadastrar(){
        try {
            $query = 'INSERT INTO 
                            cliente (email,pass,company_name,cnpj,tel,tel_2)
                        VALUES 
                            (:email,:pass,:company_name,:cnpj,:tel,:tel2)';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':pass', $this->__get('pass'));
            $stmt->bindValue(':tel', $this->__get('tel'));
            $stmt->bindValue(':tel2', $this->__get('tel2'), null != $this->__get('tel2') ? PDO::PARAM_STR : PDO::PARAM_NULL );
            $stmt->bindValue(':cnpj', $this->__get('cnpj'));
            $stmt->bindValue(':company_name', $this->__get('company_name'));
            $stmt->execute();
            
            $this->__set('id',$this->con->lastInsertId());
            return $this;
        } catch (\PDOException $e) {
            echo $e;
        }
    }

    public function getPedidos(){
        try{
            $query = 'SELECT
                        co.id,
                        co.pedido,
                        co.status,
                        st.descricao
                    FROM
                        cotacao_cliente_info as co
                        LEFT JOIN status_pedido as st
                    ON 
                        (co.status = st.id)
                    WHERE
                        co.cliente_id = :cliente_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){

        }
    }

    public function getTotalPedidos(){
        try{
            $query = 'SELECT
                        count(*) as total
                    FROM
                        cotacao_cliente_info
                    WHERE
                        cliente_id = :cliente_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){

        }
    }

    public function getItensPedido(){
        try{
            $query = 'SELECT
                        co.id,
                        co.produto_id,
                        p.descricao,
                        co.pretencao
                    FROM
                        cotacao_cliente_lista as co
                        LEFT JOIN produto as p
                    ON 
                        (co.produto_id = p.id)
                    WHERE
                        co.cliente_id = :cliente_id AND
                        co.pedido_id = :pedido_id
                    ORDER BY
                        p.descricao';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->bindValue(':pedido_id',$this->__get('ultimo_pedido'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){

        }
    }

    public function removerItemPedido($index){
       try{
            $query = 'DELETE FROM cotacao_cliente_lista WHERE id = :id AND cliente_id = :cliente_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':id',$index);
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            return $stmt->execute();
       }catch(\PDOException $e){

       }
    }

    public function removerPedido(){
        try{
            $query = 'DELETE FROM cotacao_fornecedor_lista WHERE pedido_id = :pedido_id AND cliente_id = :cliente_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':pedido_id',$this->__get('ultimo_pedido'));
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->execute();

            $query = 'DELETE FROM cotacao_cliente_lista WHERE pedido_id = :pedido_id AND cliente_id = :cliente_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':pedido_id',$this->__get('ultimo_pedido'));
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->execute();

            $query = 'DELETE FROM cotacao_cliente_info WHERE pedido = :pedido_id AND cliente_id = :cliente_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':pedido_id',$this->__get('ultimo_pedido'));
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->execute();

            return true;
       }catch(\PDOException $e){
            return false;
       }
    }

    public function novoPedido(){
        try{
            $query = 'SELECT ultimo_pedido FROM cliente WHERE id = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':id',$this->__get('id'));
            $stmt->execute();
            
            $ultimo_pedido = $stmt->fetch(\PDO::FETCH_ASSOC)['ultimo_pedido'];
            $ultimo_pedido++;

            $query = 'UPDATE cliente SET ultimo_pedido = :ultimo_pedido WHERE id = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':ultimo_pedido',$ultimo_pedido);
            $stmt->bindValue(':id',$this->__get('id'));
            $stmt->execute();

            $query = 'INSERT INTO cotacao_cliente_info(cliente_id,pedido) VALUES(:cliente_id,:pedido)';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->bindValue(':pedido',$ultimo_pedido);
            $stmt->execute();

            return $ultimo_pedido;
        }catch(\PDOException $e){
            return -1;
        }
    }

    public function getStatusPedido(){
        try{
            $query = 'SELECT
                            status
                        FROM 
                            cotacao_cliente_info 
                        WHERE 
                            cliente_id = :cliente_id AND
                            pedido = :pedido';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->bindValue(':pedido',$this->__get('ultimo_pedido'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
       }catch(\PDOException $e){

       }
    }

    public function alterarStatusPedido(){
        try{
            $query = 'UPDATE
                            cotacao_cliente_info 
                        SET 
                            status = !status 
                        WHERE 
                            cliente_id = :cliente_id AND
                            pedido = :pedido';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->bindValue(':pedido',$this->__get('ultimo_pedido'));
            return $stmt->execute();
       }catch(\PDOException $e){

       }
    }

    public function getValorCotadoParaProduto($produto_id){
        try{
            $query = 'SELECT
                            co.valor,
                            co.fornecedor_id,
                            co.aprovado,
                            co.obs,
                            fo.company_name
                        FROM
                            cotacao_fornecedor_lista as co
                            LEFT JOIN fornecedor as fo
                        ON
                            (co.fornecedor_id = fo.id)
                        WHERE
                            co.cliente_id = :cliente_id AND
                            co.pedido_id = :pedido_id AND
                            co.produto_id = :produto_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->bindValue(':pedido_id',$this->__get('ultimo_pedido'));
            $stmt->bindValue(':produto_id',$produto_id);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){

        }
    }

    public function aprovarDesaprovar($fornecedor_id,$produto_id){
        try{
            $query = 'UPDATE
                        cotacao_fornecedor_lista
                    SET
                        aprovado = !aprovado
                    WHERE
                        fornecedor_id = :fornecedor_id AND
                        pedido_id = :pedido_id AND
                        cliente_id = :cliente_id AND
                        produto_id = :produto_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':fornecedor_id',$fornecedor_id);
            $stmt->bindValue(':pedido_id',$this->__get('ultimo_pedido'));
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->bindValue(':produto_id',$produto_id);
            return $stmt->execute();
        }catch(\PDOException $e){

        }
    }

    public function incluirObs($fornecedor_id,$produto_id,$obs){
        try{
            $query = 'UPDATE
                        cotacao_fornecedor_lista
                    SET
                        obs = :obs
                    WHERE
                        fornecedor_id = :fornecedor_id AND
                        pedido_id = :pedido_id AND
                        cliente_id = :cliente_id AND
                        produto_id = :produto_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':fornecedor_id',$fornecedor_id);
            $stmt->bindValue(':pedido_id',$this->__get('ultimo_pedido'));
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->bindValue(':produto_id',$produto_id);
            $stmt->bindValue(':obs',$obs);
            return $stmt->execute();
        }catch(\PDOException $e){

        }
    }

    public function getObs($fornecedor_id,$produto_id){
        try{
            $query = 'SELECT
                            obs
                        FROM
                            cotacao_fornecedor_lista
                        WHERE
                            fornecedor_id = :fornecedor_id AND
                            pedido_id = :pedido_id AND
                            cliente_id = :cliente_id AND
                            produto_id = :produto_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':fornecedor_id',$fornecedor_id);
            $stmt->bindValue(':pedido_id',$this->__get('ultimo_pedido'));
            $stmt->bindValue(':cliente_id',$this->__get('id'));
            $stmt->bindValue(':produto_id',$produto_id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){

        }
    }

    public function setPretencao($produto_index,$pretencao){
        try{
            $query = "UPDATE
                            cotacao_cliente_lista
                        SET
                            pretencao = :pretencao
                        WHERE 
                            cliente_id = :cliente_id AND
                            pedido_id = :pedido_id AND
                            id = :produto_index";
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(":pretencao",$pretencao);
            $stmt->bindValue(":cliente_id",$this->__get('id'));
            $stmt->bindValue(":pedido_id",$this->__get('ultimo_pedido'));
            $stmt->bindValue(":produto_index",$produto_index);
            return $stmt->execute();
        }catch(\PDOException $e){

        }
        
    }

    public function atualizarCadastro(){
        try{
            $query = 'UPDATE
                        cliente
                    SET
                        company_name = :company_name,
                        cnpj = :cnpj,
                        tel = :tel,
                        tel_2 = :tel2,
                        email = :email
                    WHERE
                        id = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':company_name',$this->__get('company_name'));
            $stmt->bindValue(':cnpj',$this->__get('cnpj'));
            $stmt->bindValue(':tel',$this->__get('tel'));
            $stmt->bindValue(':tel2',$this->__get('tel2'));
            $stmt->bindValue(':email',$this->__get('email'));
            $stmt->bindValue(':id',$this->__get('id'));
            return $stmt->execute();
        }catch(\PDOException $e){
            echo '<p>'.$e->getMessage().'</p>';
            return false;
        }
    }

    public function atualizarSenha(){
        try{
            $query = 'UPDATE
                        cliente
                    SET
                        pass = :pass
                    WHERE
                        id = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':pass',$this->__get('pass'));
            $stmt->bindValue(':id',$this->__get('id'));
            return $stmt->execute();
        }catch(\PDOException $e){
            echo '<p>'.$e->getMessage().'</p>';
            return false;
        }
    }
}

?>