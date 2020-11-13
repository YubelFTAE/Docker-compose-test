## Spring DATASOURCE (DataSourceAutoConfiguration & DataSourceProperties)
spring.datasource.url=jdbc:postgresql://localhost:5432/elecs?useSSL=false
spring.datasource.username=postgres
spring.datasource.password=123456

## Hibernate Properties
spring.jpa.show-sql=true
spring.data.jpa.repositories.enabled=true
spring.jpa.properties.hibernate.dialect = org.hibernate.dialect.PostgreSQLDialect
spring.jpa.hibernate.ddl-auto=update
spring.jpa.properties.hibernate.jdbc.lob.non_contextual_creation=true

grokonez.app.jwtSecret=jwtGrokonezSecretKey
grokonez.app.jwtExpiration=86400