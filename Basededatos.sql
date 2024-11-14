use controlasistencia
-- Tabla para las áreas de trabajo
CREATE TABLE area (
    id_area INT AUTO_INCREMENT PRIMARY KEY,
    nombre_area VARCHAR(50) NOT NULL
);

-- Tabla de empleados
CREATE TABLE empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    cargo ENUM('Administrador', 'Empleado', 'Jefe de Área') NOT NULL,
    id_area INT,
    puesto VARCHAR(50) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_area) REFERENCES area(id_area)
);

-- Tabla de usuarios para las credenciales
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_empleado INT,
    nombre_usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,  -- La contraseña debe almacenarse encriptada
    FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
);

-- Tabla para el salario y prestaciones de los empleados
CREATE TABLE salario (
    id_salario INT AUTO_INCREMENT PRIMARY KEY,
    id_empleado INT,
    salario_base DECIMAL(10, 2) NOT NULL,
    prestaciones_activas BOOLEAN NOT NULL DEFAULT TRUE,
    estado_laboral ENUM('Activo', 'Inactivo') NOT NULL,
    tipo_contrato ENUM('Freelance', 'Planillero') NOT NULL,
    numero_identificacion VARCHAR(50),
    pago_extra_horas BOOLEAN DEFAULT FALSE,
    pago_nocturno BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
);

-- Tabla para el registro de horas de trabajo
CREATE TABLE horas_trabajo (
    id_hora_trabajo INT AUTO_INCREMENT PRIMARY KEY,
    id_empleado INT,
    fecha DATE NOT NULL,
    hora_entrada TIME NOT NULL,
    hora_salida TIME,
    horas_laboradas DECIMAL(5, 2),
     salario_base DECIMAL(10, 2),
    horas_extras DECIMAL(5, 2) GENERATED ALWAYS AS (
        IF(horas_laboradas > 8, horas_laboradas - 8, 0)
    ) VIRTUAL,
    horas_nocturnas DECIMAL(5, 2) GENERATED ALWAYS AS (
        IF(HOUR(hora_entrada) >= 21 OR HOUR(hora_salida) <= 6, horas_laboradas, 0)
    ) VIRTUAL,
    pago_total DECIMAL(10, 2) GENERATED ALWAYS AS (
        (horas_laboradas * salario_base) +
        (horas_extras * (salario_base * 1.5)) + 
        (horas_nocturnas * (salario_base * 2))
    ) VIRTUAL,
    estado_validacion ENUM('Pendiente', 'Aprobado', 'Rechazado') DEFAULT 'Pendiente',
    comentario_validacion VARCHAR(255),
    FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
);

-- Inserción de datos en la tabla `area`
INSERT INTO area (nombre_area) VALUES 
('Recursos Humanos'), 
('Tecnología'), 
('Ventas');

-- Inserción de empleados con diferentes roles (Administrador, Jefe de Área y Empleado)
INSERT INTO empleados (nombre, apellido, cargo, id_area, puesto, correo, telefono) VALUES
('Carlos', 'González', 'Administrador', 1, 'Administrador General', 'carlos.admin@example.com', '555-1234'),
('Laura', 'Martínez', 'Jefe de Área', 2, 'Jefe de Tecnología', 'laura.jefe@example.com', '555-5678'),
('Ana', 'López', 'Empleado', 3, 'Vendedor', 'ana.empleado@example.com', '555-9101');

-- Inserción de usuarios para cada empleado (con contraseña ficticia encriptada)
INSERT INTO usuarios (id_empleado, nombre_usuario, contrasena) VALUES
(1, 'carlos.admin', '$2y$10$1234567890abcdefgHIJKLMNOPQRSTUV'),  -- Contraseña encriptada para 'admin123'
(2, 'laura.jefe', '$2y$10$0987654321abcdefgHIJKLMNOPQRSTUV'),   -- Contraseña encriptada para 'jefe123'
(3, 'ana.empleado', '$2y$10$1122334455abcdefgHIJKLMNOPQRSTUV');  -- Contraseña encriptada para 'empleado123'

-- Inserción de salario y prestaciones para los empleados
INSERT INTO salario (id_empleado, salario_base, prestaciones_activas, estado_laboral, tipo_contrato, numero_identificacion, pago_extra_horas, pago_nocturno) VALUES
(1, 3000.00, TRUE, 'Activo', 'Planillero', 'DUI-123456-7890', TRUE, TRUE),
(2, 2500.00, TRUE, 'Activo', 'Planillero', 'DUI-234567-8901', TRUE, TRUE),
(3, 1000.00, FALSE, 'Activo', 'Freelance', 'DUI-345678-9012', FALSE, FALSE);

-- Inserción de registros de horas de trabajo (entrada y salida) para validar
INSERT INTO horas_trabajo (id_empleado, fecha, hora_entrada, hora_salida, horas_laboradas, estado_validacion) VALUES
(3, '2024-11-13', '08:00:00', '17:00:00', 9.0, 'Pendiente'),
(3, '2024-11-14', '09:00:00', '18:30:00', 9.5, 'Pendiente'),
(2, '2024-11-13', '07:30:00', '16:30:00', 9.0, 'Aprobado'),
(1, '2024-11-13', '08:00:00', '16:00:00', 8.0, 'Aprobado');
