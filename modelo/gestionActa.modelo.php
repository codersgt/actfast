<?php

    require 'conexion.php';

    class gestionActa{

        public function ConsultarTodo(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select er.id_entrega_recepcion, p.nombre_persona as funcionario, a.codigo, pe.nombre_persona as custodio, er.fecha from entrega_recepcion er inner join persona p on er.persona_id = p.id_persona inner join activo a on er.activo_id = a.id_activo inner join custodio cu on er.custodio_id = cu.id_custodio inner join persona pe on cu.persona_id = pe.id_persona order by er.id_entrega_recepcion asc limit 50");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function ConsultarPorId($idgestionActa){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select er.id_entrega_recepcion, p.nombre_persona as funcionario, a.codigo, pe.nombre_persona as custodio, er.fecha from entrega_recepcion er inner join persona p on er.persona_id = p.id_persona inner join activo a on er.activo_id = a.id_activo inner join custodio cu on er.custodio_id = cu.id_custodio inner join persona pe on cu.persona_id = pe.id_persona where er.id_entrega_recepcion = :idEntregaRecepcion");
            $stmt->bindValue(":idEntregaRecepcion", $idgestionActa, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function ConsultarPorIdRow($idGestionActa,$campoBuscar){
            $conexion = new Conexion();

            if($campoBuscar == "Funcionario"){
                $stmt = $conexion->prepare("select er.id_entrega_recepcion, p.nombre_persona as funcionario, a.codigo, pe.nombre_persona as custodio, er.fecha from entrega_recepcion er inner join persona p on er.persona_id = p.id_persona inner join activo a on er.activo_id = a.id_activo inner join custodio cu on er.custodio_id = cu.id_custodio inner join persona pe on cu.persona_id = pe.id_persona where p.nombre_persona like :patron order by er.id_entrega_recepcion asc");
                $stmt->bindValue(":patron", "%".$idGestionActa."%", PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            if($campoBuscar == "Activo"){
                $stmt = $conexion->prepare("select er.id_entrega_recepcion, p.nombre_persona as funcionario, a.codigo, pe.nombre_persona as custodio, er.fecha from entrega_recepcion er inner join persona p on er.persona_id = p.id_persona inner join activo a on er.activo_id = a.id_activo inner join custodio cu on er.custodio_id = cu.id_custodio inner join persona pe on cu.persona_id = pe.id_persona where a.codigo like :patron order by er.id_entrega_recepcion asc");
                $stmt->bindValue(":patron", "%".$idGestionActa."%", PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function Guardar($nombreFuncionario, $codigoActivo, $nombreCustodio, $fecha){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select ID_PERSONA FROM persona where NOMBRE_PERSONA = :nombreFuncionario");
            $stmt->bindValue(":nombreFuncionario", $nombreFuncionario, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $idPersona = $results['ID_PERSONA'];
       
            $stmt = $conexion->prepare("select ID_ACTIVO from activo where codigo = :codigoActivo");
            $stmt->bindValue(":codigoActivo", $codigoActivo, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $idActivo = $results['ID_ACTIVO'];

            $stmt = $conexion->prepare("select cu.id_custodio from custodio cu inner join persona p on cu.persona_id = p.id_persona where p.nombre_persona = :nombreCustodio");
            $stmt->bindValue(":nombreCustodio", $nombreCustodio, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $idCustodio = $results['id_custodio'];
                
            $stmt = $conexion->prepare("INSERT INTO `entrega_recepcion`
                                                    (`PERSONA_ID`,
                                                    `ACTIVO_ID`,
                                                    `CUSTODIO_ID`,
                                                    `FECHA`)
                                        VALUES (:idPersona,
                                                :idActivo,
                                                :idCustodio,    
                                                :fecha);");
            $stmt->bindValue(":idPersona", $idPersona, PDO::PARAM_INT);
            $stmt->bindValue(":idActivo", $idActivo, PDO::PARAM_INT);
            $stmt->bindValue(":idCustodio", $idCustodio, PDO::PARAM_INT);
            $stmt->bindValue(":fecha", $fecha, PDO::PARAM_STR);
            if($stmt->execute()){
                    return "OK";
                }else{
                    return "Error: se ha generado un error al guardar la información";
                }
            }
            
        public function Modificar($idActa, $nombreFuncionario, $codigoActivo, $nombreCustodio, $fecha){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select ID_PERSONA FROM persona where NOMBRE_PERSONA = :nombreFuncionario");
            $stmt->bindValue(":nombreFuncionario", $nombreFuncionario, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $idPersona = $results['ID_PERSONA'];
       
            $stmt = $conexion->prepare("select ID_ACTIVO from activo where codigo = :codigoActivo");
            $stmt->bindValue(":codigoActivo", $codigoActivo, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $idActivo = $results['ID_ACTIVO'];

            $stmt = $conexion->prepare("select cu.id_custodio from custodio cu inner join persona p on cu.persona_id = p.id_persona where p.nombre_persona = :nombreCustodio");
            $stmt->bindValue(":nombreCustodio", $nombreCustodio, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $idCustodio = $results['id_custodio'];
                
            $stmt = $conexion->prepare("UPDATE `entrega_recepcion`
                                            SET `PERSONA_ID` = :idPersona,
                                            `ACTIVO_ID` = :idActivo,
                                            `CUSTODIO_ID` = :idCustodio,
                                            `FECHA` = :fecha
                                            WHERE `ID_ENTREGA_RECEPCION` = :idActa;");
            $stmt->bindValue(":idPersona", $idPersona, PDO::PARAM_INT);
            $stmt->bindValue(":idActivo", $idActivo, PDO::PARAM_INT);
            $stmt->bindValue(":idCustodio", $idCustodio, PDO::PARAM_INT);
            $stmt->bindValue(":fecha", $fecha, PDO::PARAM_STR);
            $stmt->bindValue(":idActa", $idActa, PDO::PARAM_INT);
            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al modificar la información";
            }
        }

        public function Eliminar($idEntregaRecepcion){
            $conexion = new Conexion();
            $stmtdel = $conexion->prepare("DELETE FROM entrega_recepcion WHERE id_entrega_recepcion = :idEntregaRecepcion");
            $stmtdel->bindValue(":idEntregaRecepcion", $idEntregaRecepcion, PDO::PARAM_INT);
            if($stmtdel->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al eliminar el registro";
            }
        }

        public function listarFuncionario(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("SELECT NOMBRE_PERSONA FROM persona");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function listarActivo(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select a.codigo activo from activo a;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function listarCustodio(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select p.nombre_persona from custodio cu inner join persona p on cu.persona_id = p.id_persona;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

       
    }
?>