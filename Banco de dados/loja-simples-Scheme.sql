
CREATE TABLE compra
(
  ID          INT  NOT NULL AUTO_INCREMENT,
  ID_user     INT  NOT NULL,
  data-inicio DATE NOT NULL,
  data-fim    DATE NOT NULL,
  PRIMARY KEY (ID)
);

CREATE TABLE endereco
(
  ID      INT         NOT NULL AUTO_INCREMENT COMMENT 'começa em 1 para cada usuário',
  ID_user INT         NOT NULL COMMENT 'AUTO-INCREMENT',
  nome    VARCHAR(50) NULL     COMMENT 'nome do endereço (exemplo: casa, trabalho)',
  CEP     VARCHAR(10) NOT NULL,
  PRIMARY KEY (ID)
) COMMENT 'tabela de ccade enderecos dos usuarios';

CREATE TABLE favoritos
(
  ID_user    INT NOT NULL,
  ID_produto INT NOT NULL
);

CREATE TABLE marca
(
  ID     INT          NOT NULL AUTO_INCREMENT,
  nome   VARCHAR(100) NOT NULL,
  imagem VARCHAR(255) NULL     COMMENT 'caminho do local da imagem salva',
  PRIMARY KEY (ID)
);

CREATE TABLE produto
(
  ID         INT          NOT NULL AUTO_INCREMENT,
  nome       VARCHAR(100) NOT NULL,
  descricao  varchar(255) NULL    ,
  ID_marca   INT          NOT NULL,
  quantidade INT          NOT NULL DEFAULT 0,
  preco_unit DECIMAL      NULL    ,
  PRIMARY KEY (ID)
);

CREATE TABLE produto_compra
(
  ID_compra  INT NOT NULL,
  ID_produto INT NOT NULL,
  quantidade INT NOT NULL
);

CREATE TABLE user
(
  ID       INT          NOT NULL AUTO_INCREMENT,
  Username VARCHAR(150) NOT NULL,
  Senha    VARCHAR(255) NOT NULL COMMENT 'HASH',
  PRIMARY KEY (ID)
) COMMENT 'tabela de usuários';

ALTER TABLE user
  ADD CONSTRAINT UQ_Username UNIQUE (Username);

ALTER TABLE endereco
  ADD CONSTRAINT FK_user_TO_endereco
    FOREIGN KEY (ID_user)
    REFERENCES user (ID);

ALTER TABLE produto
  ADD CONSTRAINT FK_marca_TO_produto
    FOREIGN KEY (ID_marca)
    REFERENCES marca (ID);

ALTER TABLE compra
  ADD CONSTRAINT FK_user_TO_compra
    FOREIGN KEY (ID_user)
    REFERENCES user (ID);

ALTER TABLE produto_compra
  ADD CONSTRAINT FK_compra_TO_produto_compra
    FOREIGN KEY (ID_compra)
    REFERENCES compra (ID);

ALTER TABLE produto_compra
  ADD CONSTRAINT FK_produto_TO_produto_compra
    FOREIGN KEY (ID_produto)
    REFERENCES produto (ID);

ALTER TABLE favoritos
  ADD CONSTRAINT FK_user_TO_favoritos
    FOREIGN KEY (ID_user)
    REFERENCES user (ID);

ALTER TABLE favoritos
  ADD CONSTRAINT FK_produto_TO_favoritos
    FOREIGN KEY (ID_produto)
    REFERENCES produto (ID);
