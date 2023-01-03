## Setting Up Kubeadm IAC for AWS EC2
provider "aws" {
  region = "ap-south-1"
}

resource "aws_vpc" "kube_vpc" {
  cidr_block       = "10.0.0.0/16"  
  instance_tenancy = "default"
  enable_dns_hostnames = true

  tags = {
    Name = "Kube_VPC"
  }
}

resource "aws_subnet" "kube_subnet1" {
  vpc_id     = aws_vpc.kube_vpc.id
  cidr_block = "10.0.1.0/24"
  availability_zone = "ap-south-1a"
  map_public_ip_on_launch = true

  tags = {
    Name = "Public_1A"
  }
}

resource "aws_subnet" "kube_subnet2" {
  vpc_id     = aws_vpc.kube_vpc.id
  cidr_block = "10.0.20.0/24"
  map_public_ip_on_launch = true
  availability_zone = "ap-south-1b"

  tags = {
    Name = "Public_1B"
  }
}

resource "aws_internet_gateway" "kube_gw" {
  vpc_id = aws_vpc.kube_vpc.id

  tags = {
    Name = "Kube_IG"
  }
}

resource "aws_route_table" "kube_public_rt" {
  vpc_id = aws_vpc.kube_vpc.id

 
  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.kube_gw.id
  }

  tags = {
    Name = "Public Route Table"
  }
}


resource "aws_route_table_association" "Public_association1" {
  subnet_id      = aws_subnet.kube_subnet1.id
  route_table_id = aws_route_table.kube_public_rt.id
}

resource "aws_route_table_association" "Public_association2" {
  subnet_id      = aws_subnet.kube_subnet2.id
  route_table_id = aws_route_table.kube_public_rt.id
}

variable "password" {
  type = string
  sensitive = true
  default = "8084"   
}


## Master Node Instance
resource "aws_instance" "control_plane" {
  ami =  "ami-07ffb2f4d65357b42"
  instance_type = "t2.medium"
  key_name = "kubernetes"
  subnet_id = aws_subnet.kube_subnet1.id
  vpc_security_group_ids = [aws_security_group.master-node-sg.id]

  tags = {
    Name = "Control Plane"
  }

  user_data = <<EOF
#!/bin/bash
sudo apt-get update -y
sudo useradd -m -p $(echo "${var.password}"  | openssl passwd -1 -stdin) ansible

cat >/etc/ssh/sshd_config <<EOF2
Include /etc/ssh/sshd_config.d/*.conf
PubkeyAuthentication yes
PasswordAuthentication yes
KbdInteractiveAuthentication no
UsePAM yes
X11Forwarding yes
PrintMotd no
AcceptEnv LANG LC_*
Subsystem       sftp    /usr/lib/openssh/sftp-server
EOF2

cat >/etc/sudoers <<EOF3
Defaults        env_reset
Defaults        mail_badpass
Defaults        secure_path="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/snap/bin"
Defaults        use_pty
root    ALL=(ALL:ALL) ALL
ansible ALL=(ALL:ALL) NOPASSWD:ALL
%admin ALL=(ALL) ALL
%sudo   ALL=(ALL:ALL) ALL
@includedir /etc/sudoers.d
EOF3

systemctl restart sshd
EOF
}

## Worker Node Instance
resource "aws_instance" "worker_node" {
  count = 2
  ami =  "ami-07ffb2f4d65357b42"
  instance_type = "t2.micro"
  key_name = "kubernetes"
  subnet_id = aws_subnet.kube_subnet1.id
  vpc_security_group_ids = [aws_security_group.worker-node-sg.id]

  tags = {
    Name = "WorkerNode-${count.index + 1}"
  }

  user_data = <<EOF
#!/bin/bash
sudo apt-get update -y
sudo useradd -m -p $(echo "${var.password}"  | openssl passwd -1 -stdin) ansible

cat >/etc/ssh/sshd_config <<EOF2
Include /etc/ssh/sshd_config.d/*.conf
PubkeyAuthentication yes
PasswordAuthentication yes
KbdInteractiveAuthentication no
UsePAM yes
X11Forwarding yes
PrintMotd no
AcceptEnv LANG LC_*
Subsystem       sftp    /usr/lib/openssh/sftp-server
EOF2

cat >/etc/sudoers <<EOF3
Defaults        env_reset
Defaults        mail_badpass
Defaults        secure_path="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/snap/bin"
Defaults        use_pty
root    ALL=(ALL:ALL) ALL
ansible ALL=(ALL:ALL) NOPASSWD:ALL
%admin ALL=(ALL) ALL
%sudo   ALL=(ALL:ALL) ALL
@includedir /etc/sudoers.d
EOF3

systemctl restart sshd
EOF
}

resource "aws_security_group" "master-node-sg" {
  vpc_id = aws_vpc.kube_vpc.id
  name = "master-node-sg"
  description = "Security Group for Master Node (Control Plane) of Kubernetes"
  # ingress rules
  ingress {
    from_port = 22
    to_port = 22
    protocol = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 6443
    to_port     = 6443
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 2379
    to_port     = 2380
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 443
    to_port     = 443
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 8080
    to_port     = 8080
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 10250
    to_port     = 10260
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 6783
    to_port     = 6783
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 6784
    to_port     = 6784
    protocol    = "udp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 30000
    to_port     = 32767
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  # egress rule
  egress {
    from_port = 0
    to_port = 0
    protocol = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

}

resource "aws_security_group" "worker-node-sg" {
  vpc_id = aws_vpc.kube_vpc.id
  name = "worker-node-sg"
  description = "Security Group for Worker Node of Kubernetes"
  # ingress rules
  ingress {
    from_port = 22
    to_port = 22
    protocol = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 443
    to_port     = 443
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 8080
    to_port     = 8080
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 10250
    to_port     = 10260
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 6783
    to_port     = 6783
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 6784
    to_port     = 6784
    protocol    = "udp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  ingress {
    from_port   = 30000
    to_port     = 32767
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  # egress rule
  egress {
    from_port = 0
    to_port = 0
    protocol = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

}