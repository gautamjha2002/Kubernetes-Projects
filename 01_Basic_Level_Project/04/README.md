# Create Kubernetes cluster on AWS EC2

This project uses Terraform and Ansible to set up a Kubernetes cluster on EC2. The cluster consists of 3 EC2 instances: 1 master and 2 workers  

## Requirements  
* Terraform
* Ansible

## Usage  
1. Clone The repository  
``git clone https://github.com/gautamjha2002/Kubernetes-Projects.git``  

2. Change the directory where terraform code is present  
``cd Kubernetes-Projects\01_Basic_Level_Project\04\Terraform``  

3. Initialize Terraform  
``terraform init``  
NOTE :- before initilizing terraform you mst ensure that Your AWS access key and AWS secret keys are configured in your system environment variable.  

4. Apply the terraform configuration  
``terraform apply -var 'password=<password>'``  
This is the password for your ansible user in your ec2 instance you can provide any password of your choice you can also skip the -var option also in this case you password will be 8084 by default.

5. create ansible user in you local system  
``useradd -m ansible``  
This will be your ansible admin by this account you are going to work with your remote server

6. Create ssh keys from you ansible user  
``su ansible``  
``ssh-keygen``  

7. copy the key id to your remote server  
``ssh-copy-id ansible@<public-ip-address>``  
you need to provide Public ip address of remote instance which is created using terraform you can find them in your AWS account (mumbai region) 

NOTE:- copying the id will may need to provide ansible password of you remote instance which you have set when applying the terraform command in the 4th step. Or if you did not provided the password it will be 8084 by default.

8. In you ansible host file you need to provide the public ip address of your ec2 instance.  
```
Make sure that you have created two group 1 for master node and other for worker nodes. TO edit the host file :-  

vi /etc/ansible/hosts

In the file create 2 groups, for one for master and one for worker node as shown as below
[master]
<ip_address_of_control_plane>

[worker]
<ip_address_of_worker_node1>
<ip_address_of_worker_node2>
``` 

9. Run the ansible playbook provided in the code Ansible directory.  
``cd ..``  
``cd Ansible``  
``cd configuration.yaml``

10. After the process is done connect to your control plane node and use ``kubectl`` command to manage you cluster.

## Cleanup

To destroy the resources created by this project, run the following command from your Terraform directory:
``terraform destroy``